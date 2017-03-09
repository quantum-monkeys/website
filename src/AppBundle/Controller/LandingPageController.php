<?php

namespace AppBundle\Controller;

use AppBundle\Form\Type\LandingPageContactType;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

class LandingPageController extends Controller
{
    public function indexAction(string $slug, Request $request)
    {
        $landingPageTranslation = $this->get('doctrine')->getRepository('AppBundle:LandingPageTranslation')->findOneBy([
            'locale' => $request->getLocale(),
            'slug' => $slug
        ]);

        if ($landingPageTranslation === null) {
            throw new NotFoundHttpException();
        }

        $form = $this->createForm(LandingPageContactType::class, null, [
            'action' => $this->generateUrl('contact'),
        ]);

        return $this->render('AppBundle:LandingPage:index.html.twig', [
            'landingPageTranslation' => $landingPageTranslation,
            'form' => $form->createView()
        ]);
    }
}
