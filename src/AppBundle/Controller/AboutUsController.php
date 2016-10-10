<?php

namespace AppBundle\Controller;

use AppBundle\Form\Type\ContactType;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
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
}
