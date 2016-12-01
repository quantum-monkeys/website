<?php

namespace AppBundle\Controller;

use AppBundle\Form\Type\ContactType;
use AppBundle\Form\Type\NewsletterType;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;

class NewsletterController extends Controller
{
    public function submitAction(Request $request) {
        $form = $this->createForm(NewsletterType::class);

        $form->handleRequest($request);

        if ($form->isValid()) {
            $data = $form->getData();

            $result = $this->get('app.manager.newsletter')->subscribe(
                $data['email'],
                $data['firstName'],
                $data['lastName']
            );

            return $this->render('@App/Newsletter/form_response.html.twig', [
                'result' => $result,
            ]);
        }

        return $this->render(
            '@App/Newsletter/form.html.twig',
            [
                'form' => $form->createView(),
            ]
        );
    }

    protected function newsletter(string $templateName)
    {
        $form = $this->createForm(NewsletterType::class, null, [
            'action' => $this->generateUrl('newsletter_submit'),
        ]);

        return $this->render(
            $templateName,
            [
                'form' => $form->createView(),
            ]
        );
    }

    public function indexAction() {
        $this->get('app.manager.breadcrumb_generator')->generateNewsletter();

        return $this->newsletter('@App/Newsletter/index.html.twig');
    }

    public function popupAction() {
        return $this->newsletter('@App/Newsletter/popup.html.twig');
    }
}
