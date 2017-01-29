<?php

namespace AppBundle\Controller;

use AppBundle\Entity\EventOccurrence;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\ParamConverter;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Intl\Intl;

class CoachingController extends Controller
{
    public function indexAction()
    {
        $this->get('app.manager.breadcrumb_generator')->generateServices();
        $services = $this->get('doctrine')->getRepository('AppBundle:Coaching\Service')->findBy(
            [],
            [
                'position' => 'asc'
            ]
        );

        return $this->render(
            'AppBundle:Coaching:index.html.twig',
            [
                'services' => $services
            ]
        );
    }
}
