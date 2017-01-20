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
        return $this->render('AppBundle:Home:index.html.twig', []);
    }
}
