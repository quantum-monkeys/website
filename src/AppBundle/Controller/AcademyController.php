<?php

namespace AppBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class AcademyController extends Controller
{
    public function indexAction()
    {
        $this->get('app.manager.breadcrumb_generator')->generateAcademy();

        return $this->render('AppBundle:Academy:index.html.twig', []);
    }
}
