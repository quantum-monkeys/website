<?php

namespace AppBundle\Controller;

use AppBundle\Entity\EventOccurrence;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\ParamConverter;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Intl\Intl;

class ServicesController extends Controller
{
    public function indexAction()
    {
        $this->get('app.manager.breadcrumb_generator')->generateServices();

        return $this->render('AppBundle:Services:index.html.twig', []);
    }

    public function coachingAction()
    {
        $this->get('app.manager.breadcrumb_generator')->generateServices();
        $services = $this->get('doctrine')->getRepository('AppBundle:Services\Service')->findBy(
            [],
            [
                'position' => 'asc'
            ]
        );

        return $this->render(
            'AppBundle:Services:coaching.html.twig',
            [
                'services' => $services
            ]
        );
    }

    public function academyAction()
    {
        $this->get('app.manager.breadcrumb_generator')->generateAcademy();

        return $this->render('AppBundle:Services:academy.html.twig', []);
    }

    public function studioAction()
    {
        $this->get('app.manager.breadcrumb_generator')->generateStudio();

        $packages = $this->get('doctrine')->getRepository('AppBundle:Services\DevelopmentPackage')->findBy(
            [],
            [
                'position' => 'asc'
            ]
        );
        $extraPackages = $this->get('doctrine')->getRepository('AppBundle:Services\ExtraDevelopmentPackage')->findBy(
            [],
            [
                'position' => 'asc'
            ]
        );

        return $this->render(
            'AppBundle:Services:studio.html.twig',
            [
                'packages' => $packages,
                'extraPackages' => $extraPackages,
            ]
        );
    }
}
