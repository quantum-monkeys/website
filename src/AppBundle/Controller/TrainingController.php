<?php

namespace AppBundle\Controller;

use AppBundle\Entity\EventOccurrence;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\ParamConverter;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Intl\Intl;

class TrainingController extends Controller
{
    public function indexAction(Request $request)
    {
        $this->get('app.manager.breadcrumb_generator')->generateTrainings();
        $trainings = $this->get('doctrine')->getRepository('AppBundle:Events\Seminar')->findAll();

        return $this->render(
            'AppBundle:Training:index.html.twig',
            [
                'trainings' => $trainings
            ]
        );
    }
}
