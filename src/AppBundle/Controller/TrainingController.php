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
        $trainings = $this->get('doctrine')->getRepository('AppBundle:Event')->findBy([
            'lang' => $request->getLocale(),
        ]);

        return $this->render(
            'AppBundle:Training:index.html.twig',
            [
                'trainings' => $trainings
            ]
        );
    }
}
