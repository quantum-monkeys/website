<?php

namespace AppBundle\Controller;

use AppBundle\Entity\EventOccurrence;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\ParamConverter;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Intl\Intl;

class DiscountController extends Controller
{
    public function indexAction(Request $request)
    {
        $this->get('app.manager.breadcrumb_generator')->generateDiscounts();
        $discounts = $this->get('doctrine')->getRepository('AppBundle:Discount')->findBy(
            [],
            [
                'position' => 'asc'
            ]
        );

        return $this->render(
            'AppBundle:Discount:index.html.twig',
            [
                'discounts' => $discounts
            ]
        );
    }
}
