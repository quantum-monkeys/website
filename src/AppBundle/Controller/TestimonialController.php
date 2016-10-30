<?php

namespace AppBundle\Controller;

use AppBundle\Entity\EventOccurrence;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\ParamConverter;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Intl\Intl;

class TestimonialController extends Controller
{
    const MAX_HOMEPAGE_TESTIMONIALS = 3;

    public function widgetAction(Request $request)
    {
        $testimonials = $this->get('doctrine')->getRepository('AppBundle:Testimonial')->findBy([], null, self::MAX_HOMEPAGE_TESTIMONIALS);

        return $this->render(
            'AppBundle:Testimonial:widget.html.twig',
            [
                'testimonials' => $testimonials,
            ]
        );
    }
}
