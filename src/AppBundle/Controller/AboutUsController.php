<?php

namespace AppBundle\Controller;

use AppBundle\Form\Type\ContactType;
use AppBundle\Form\Type\NewsletterType;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;

class AboutUsController extends Controller
{
    public function indexAction()
    {
        $people = $this->get('doctrine')->getRepository('AppBundle:Person')->findBy(
            [
                'quantumMonkeysMember' => true,
            ]
        );
        return $this->render(
            'AppBundle:AboutUs:index.html.twig',
            [
                'people' => $people,
            ]
        );
    }

    public function contactWidgetAction(Request $request)
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

            $message = \Swift_Message::newInstance()
                ->setSubject($data['subject'])
                ->setFrom($data['email'], $data['name'])
                ->setTo('company@quantummonkeys.com')
                ->setBody(
                    $this->renderView(
                        'AppBundle:Emails:contact.html.twig',
                        [
                            'name' => $data['name'],
                            'message' => $data['message']
                        ]
                    ),
                    'text/html'
                )
                ->addPart(
                    $this->renderView(
                        'AppBundle:Emails:contact.txt.twig',
                        [
                            'name' => $data['name'],
                            'message' => $data['message']
                        ]
                    ),
                    'text/plain'
                )
            ;

            try {
                $recipients = $this->get('mailer')->send($message);

                if ($recipients > 0) {
                    $success = true;
                }
            } catch(\Exception $e) {
            }
        } else {
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
