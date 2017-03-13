<?php

namespace AppBundle\Controller;

use AppBundle\Entity\LandingPageContact;
use AppBundle\Form\Type\LandingPageContactType;
use AppBundle\Manager\MailchimpListManager;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

class LandingPageController extends Controller
{
    public function indexAction(string $slug, Request $request)
    {
        $landingPageTranslation = $this->get('doctrine')->getRepository('AppBundle:LandingPageTranslation')->findOneBy([
            'locale' => $request->getLocale(),
            'slug' => $slug
        ]);

        if ($landingPageTranslation === null) {
            throw new NotFoundHttpException();
        }

        $landingPageContact = new LandingPageContact();
        $landingPageContact->setLandingPageTranslation($landingPageTranslation);

        $form = $this->createForm(LandingPageContactType::class, $landingPageContact, [
            'action' => $this->generateUrl('landing_page', [ 'slug' => $landingPageTranslation->getSlug() ]),
        ]);

        $form->handleRequest($request);

        if ($form->isValid()) {
            /** @var LandingPageContact $landingPageContact */
            $landingPageContact = $form->getData();

            $em = $this->getDoctrine()->getManager();
            $em->persist($landingPageContact);
            $em->flush();

            $returnCode = $this->get('app.manager.mailchimp_list')->subscribe(
                $landingPageContact->getEmail(),
                $landingPageContact->getFirstName(),
                $landingPageContact->getLastName(),
                $landingPageContact->getLandingPageTranslation()->getMailChimpListId()
            );

            if ($returnCode === MailchimpListManager::UNKNOWN_ERROR) {
                $this->get('app.manager.emails')->sendDebugEmail([
                    'message' => 'Enregistrement à Mailchimp qui fail pour '
                        . $landingPageContact->getFirstName() . ' ' . $landingPageContact->getLastName()
                        . ' (' . $landingPageContact->getEmail() . ') pour la liste '
                        . $landingPageContact->getLandingPageTranslation()->getTitle() ,
                ]);
            }

            return $this->redirect($this->generateUrl('landing_page_success', [ 'slug' => $landingPageTranslation->getSlug() ]));
        }

        return $this->render('AppBundle:LandingPage:index.html.twig', [
            'landingPageTranslation' => $landingPageTranslation,
            'form' => $form->createView()
        ]);
    }

    public function successAction(string $slug, Request $request)
    {
        $landingPageTranslation = $this->get('doctrine')->getRepository('AppBundle:LandingPageTranslation')->findOneBy([
            'locale' => $request->getLocale(),
            'slug' => $slug
        ]);

        return $this->render('AppBundle:LandingPage:success.html.twig', [
            'landingPageTranslation' => $landingPageTranslation
        ]);
    }
}
