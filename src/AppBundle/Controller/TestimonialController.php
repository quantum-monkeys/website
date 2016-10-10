<?php

namespace AppBundle\Controller;

use AppBundle\Entity\EventOccurrence;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\ParamConverter;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Intl\Intl;

class TestimonialController extends Controller
{
    public function widgetAction(Request $request)
    {
        $testimonials = $this->get('doctrine')->getRepository('AppBundle:Testimonial')->findBy([], null, 5);

        dump($testimonials);
        return $this->render(
            'AppBundle:Testimonial:widget.html.twig',
            [
                'testimonials' => $testimonials,
            ]
        );
    }
}
