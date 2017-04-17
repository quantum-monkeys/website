<?php

namespace AppBundle\Controller;

use AppBundle\Form\Type\ContactType;
use AppBundle\Form\Type\NewsletterType;
use Sonata\NewsBundle\Controller\PostController;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

class NewsController extends PostController
{
    public function archiveAction(Request $request = null)
    {
        $this->get('app.manager.breadcrumb_generator')->generateBlog();

        return parent::archiveAction($request);
    }

    public function viewAction($permalink)
    {
        $post = $this->getPostManager()->findOneByPermalink($permalink, $this->getBlog());

        $this->get('app.manager.breadcrumb_generator')->generateBlogPost($post);

        return parent::viewAction($permalink);
    }

    public function widgetAction(Request $request)
    {
        $pager = $this->getPostManager()->getPager(
            [],
            1,
            2
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

    public function feedAction()
    {
        $articles = $this->getDoctrine()->getRepository('ApplicationSonataNewsBundle:Post')->findBy(
            [],
            [ 'publicationDateStart' => 'DESC' ]
        );

        $feed = $this->get('eko_feed.feed.manager')->get('article');
        $feed->addFromArray($articles);

        return new Response($feed->render('rss'));
    }
}
