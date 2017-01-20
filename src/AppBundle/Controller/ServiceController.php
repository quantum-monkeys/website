<?php

namespace AppBundle\Controller;

use AppBundle\Entity\EventOccurrence;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\ParamConverter;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Intl\Intl;

class ServiceController extends Controller
{
    public function indexAction(Request $request)
    {
        $this->get('app.manager.breadcrumb_generator')->generateServices();
        $services = $this->get('doctrine')->getRepository('AppBundle:Services\Service')->findBy(
            [],
            [
                'position' => 'asc'
            ]
        );

        return $this->render(
            'AppBundle:Service:index.html.twig',
            [
                'services' => $services
            ]
        );
    }
}
