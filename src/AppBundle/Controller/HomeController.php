<?php

namespace AppBundle\Controller;

use AppBundle\Form\Type\ContactType;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;

class HomeController extends Controller
{
    public function indexAction()
    {
        $form = $this->createForm(ContactType::class);

        return $this->render(
            'AppBundle:Home:index.html.twig',
            [
                'form' => $form->createView()
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
}
