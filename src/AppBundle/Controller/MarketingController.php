<?php

namespace AppBundle\Controller;

use AppBundle\Entity\Marketing\CampaignTranslation;
use AppBundle\Entity\Marketing\Company;
use AppBundle\Entity\Marketing\Contact;
use AppBundle\Form\Type\EmailContactType;
use AppBundle\Form\Type\Marketing\FullContactType;
use AppBundle\Form\Type\Marketing\SimpleContactType;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

class MarketingController extends Controller
{
    protected function getCampaignTranslation(string $slug, Request $request)
    {
        $campaignTranslation = $this->get('doctrine')->getRepository('AppBundle:Marketing\CampaignTranslation')->findOneBy([
            'locale' => $request->getLocale(),
            'slug' => $slug
        ]);

        if ($campaignTranslation === null) {
            throw new NotFoundHttpException();
        }

        return $campaignTranslation;
    }

    public function indexAction(string $slug, Request $request)
    {
        $campaignTranslation = $this->getCampaignTranslation($slug, $request);
        $contact = $this->createContact($campaignTranslation);

        $form = $this->createForm(SimpleContactType::class, $contact, [
            'action' => $this->generateUrl('campaign', [
                'slug' => $campaignTranslation->getSlug()
            ]),
        ]);

        $form->handleRequest($request);

        if ($form->isValid()) {
            /** @var Contact $contact */
            $contact = $form->getData();

            $this->get('app.manager.marketing.campaign')->processContact($contact);

            return $this->redirect($this->generateUrl('campaign_success', [ 'slug' => $campaignTranslation->getSlug() ]));
        }

        return $this->render('AppBundle:Marketing:index.html.twig', [
            'campaignTranslation' => $campaignTranslation,
            'form' => $form->createView()
        ]);
    }

    public function successAction(string $slug, Request $request)
    {
        $campaignTranslation = $this->getCampaignTranslation($slug, $request);

        return $this->render('AppBundle:Marketing:success.html.twig', [
            'campaignTranslation' => $campaignTranslation
        ]);
    }

    public function contactAction(string $slug, Request $request)
    {
        $campaignTranslation = $this->getCampaignTranslation($slug, $request);

        $contactId = $request->get('contactId', null);

        if ($contactId === null) {
            $contact = $this->createContact($campaignTranslation);
        } else {
            $contact = $this->get('doctrine')->getRepository('AppBundle:Marketing\Contact')->find($contactId);
        }

        $form = $this->createForm(FullContactType::class, $contact, [
            'action' => $this->generateUrl('campaign_contact', [
                'slug' => $campaignTranslation->getSlug(),
                'contactId' => $contact->getId()
            ]),
        ]);

        $form->handleRequest($request);

        if ($form->isValid()) {
            /** @var Contact $contact */
            $contact = $form->getData();

            $this->get('app.manager.marketing.campaign')->saveContact($contact);

            return $this->redirect($this->generateUrl('campaign_contact_success', [ 'slug' => $campaignTranslation->getSlug() ]));
        }

        return $this->render('AppBundle:Marketing:contact.html.twig', [
            'campaignTranslation' => $campaignTranslation,
            'form' => $form->createView()
        ]);
    }

    public function contactSuccessAction(string $slug, Request $request)
    {
        $campaignTranslation = $this->getCampaignTranslation($slug, $request);

        return $this->render('AppBundle:Marketing:contact_success.html.twig', [
            'campaignTranslation' => $campaignTranslation
        ]);
    }

    protected function createContact(CampaignTranslation $campaignTranslation)
    {
        $contact = new Contact();
        $contact
            ->setCampaignTranslation($campaignTranslation)
            ->setCompany(new Company());

        return $contact;
    }

    public function ouibounceModalAction()
    {
        $contactForm = $this->createForm(EmailContactType::class, null, [
            'action' => $this->generateUrl('ouibounce_modal_contact_submit'),
        ]);

        return $this->render(
            'AppBundle:Marketing:_ouibounce_modal.html.twig',
            [
                'form' => $contactForm->createView(),
            ]
        );
    }

    public function ouibounceModalSubmitAction(Request $request) {
        $success = false;
        $form = $this->createForm(EmailContactType::class);

        $form->handleRequest($request);

        if ($form->isValid()) {
            $data = $form->getData();

            $success = $this->get('app.manager.emails')->sendCultureFestEmail($data['email']);
        }

        return new JsonResponse([
            'success' => $success,
        ]);
    }
}
