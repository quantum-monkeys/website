<?php

namespace AppBundle\Controller;

use AppBundle\Form\Type\ContactType;
use AppBundle\Form\Type\NewsletterType;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;

class AboutUsController extends Controller
{
    public function indexAction()
    {
        $this->get('app.manager.breadcrumb_generator')->generateAboutUs();

        $people = $this->get('doctrine')->getRepository('AppBundle:Person')->findBy(
            [
                'quantumMonkeysMember' => true,
            ],
            [
                'position' => 'asc'
            ]
        );

        return $this->render(
            'AppBundle:AboutUs:index.html.twig',
            [
                'people' => $people,
            ]
        );
    }

    public function contactWidgetAction()
    {
        $contactForm = $this->createForm(ContactType::class, null, [
            'action' => $this->generateUrl('contact'),
        ]);

        return $this->render(
            'AppBundle:AboutUs:contactWidget.html.twig',
            [
                'form' => $contactForm->createView(),
            ]
        );
    }

    public function contactAction(Request $request) {
        $success = false;
        $form = $this->createForm(ContactType::class);

        $form->handleRequest($request);

        if ($form->isValid()) {
            $data = $form->getData();

            $success = $this->get('app.manager.emails')->sendContactEmail($data);
        }

        return new JsonResponse([
            'success' => $success,
        ]);
    }

    public function newsletterAction(Request $request) {
        $form = $this->createForm(NewsletterType::class);

        $form->handleRequest($request);

        if ($form->isValid()) {
            $data = $form->getData();

            $mc = $this->get('hype_mailchimp');
            $result = $mc->getList()
                ->addMerge_vars([
                    'FNAME' => $data['firstName'],
                    'LNAME' => $data['lastName'],
                    'GROUPINGS' => [
                        [
                            'name' => 'Language',
                            'groups' => [$request->getLocale() === 'fr' ? 'Français' : 'English'],
                        ]
                    ],
                ])
                ->subscribe($data['email']);
        } else {
        }
    }
}
