<?php

namespace AppBundle\Controller;

use AppBundle\Entity\LandingPageContact;
use AppBundle\Form\Type\LandingPageContactType;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

class LandingPageController extends Controller
{
    protected function getLandingPageTranslation(string $slug, Request $request)
    {
        $landingPageTranslation = $this->get('doctrine')->getRepository('AppBundle:LandingPageTranslation')->findOneBy([
            'locale' => $request->getLocale(),
            'slug' => $slug
        ]);

        if ($landingPageTranslation === null) {
            throw new NotFoundHttpException();
        }

        return $landingPageTranslation;
    }

    public function indexAction(string $slug, Request $request)
    {
        $landingPageTranslation = $this->getLandingPageTranslation($slug, $request);

        $landingPageContact = new LandingPageContact();
        $landingPageContact->setLandingPageTranslation($landingPageTranslation);

        $form = $this->createForm(LandingPageContactType::class, $landingPageContact, [
            'action' => $this->generateUrl('landing_page', [ 'slug' => $landingPageTranslation->getSlug() ]),
        ]);

        $form->handleRequest($request);

        if ($form->isValid()) {
            /** @var LandingPageContact $landingPageContact */
            $landingPageContact = $form->getData();

            $this->get('app.manager.landing_page')->processContact($landingPageContact);

            return $this->redirect($this->generateUrl('landing_page_success', [ 'slug' => $landingPageTranslation->getSlug() ]));
        }

        return $this->render('AppBundle:LandingPage:index.html.twig', [
            'landingPageTranslation' => $landingPageTranslation,
            'form' => $form->createView()
        ]);
    }

    public function successAction(string $slug, Request $request)
    {
        $landingPageTranslation = $this->getLandingPageTranslation($slug, $request);

        return $this->render('AppBundle:LandingPage:success.html.twig', [
            'landingPageTranslation' => $landingPageTranslation
        ]);
    }
}
