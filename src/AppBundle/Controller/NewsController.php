<?php

namespace AppBundle\Controller;

use AppBundle\Form\Type\ContactType;
use AppBundle\Form\Type\NewsletterType;
use Sonata\NewsBundle\Controller\PostController;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;

class NewsController extends PostController
{

    public function widgetAction(Request $request)
    {
        $pager = $this->getPostManager()->getPager(
            [],
            1,
            4
        );

        $parameters = [
            'pager' => $pager,
            'route' => $request->get('_route'),
            'route_parameters' => $request->get('_route_params'),
        ];

        return $this->render(
            'AppBundle:News:widget.html.twig',
            $parameters
        );
    }
}
