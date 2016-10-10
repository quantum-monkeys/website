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
        $services = $this->get('doctrine')->getRepository('AppBundle:Service')->findBy([
            'lang' => $request->getLocale(),
        ]);

        return $this->render(
            'AppBundle:Service:index.html.twig',
            [
                'services' => $services
            ]
        );
    }

    public function widgetAction(Request $request)
    {
        $services = $this->get('doctrine')->getRepository('AppBundle:Service')->findBy([
            'lang' => $request->getLocale(),
        ]);

        return $this->render(
            'AppBundle:Service:widget.html.twig',
            [
                'services' => $services
            ]
        );
    }
}
