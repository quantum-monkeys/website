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

}
