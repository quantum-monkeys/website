<?php

namespace AppBundle\Controller;

use AppBundle\Form\Type\ContactType;
use AppBundle\Form\Type\NewsletterType;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;

class HomeController extends Controller
{
    public function indexAction()
    {
        $contactForm = $this->createForm(ContactType::class, null, [
            'action' => $this->generateUrl('contact'),
        ]);
        $newsletterForm = $this->createForm(NewsletterType::class, null, [
            'action' => $this->generateUrl('newsletter'),
        ]);

        return $this->render(
            'AppBundle:Home:index.html.twig',
            [
                'contactForm' => $contactForm->createView(),
                'newsletterForm' => $newsletterForm->createView()
            ]
        );
    }

    public function oldIndexAction()
    {
        $form = $this->createForm(ContactType::class);

        return $this->render(
            'AppBundle:Home:old_index.html.twig',
            [
                'form' => $form->createView()
            ]
        );
    }

    public function contactAction(Request $request) {
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
                $this->get('mailer')->send($message);
            } catch(\Exception $e) {
                die('error');
            }
            die('success');
        } else {
            die('error');
        }
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
            dump($result);

//            die('success');
        } else {
//            die('error');
        }
    }
}
