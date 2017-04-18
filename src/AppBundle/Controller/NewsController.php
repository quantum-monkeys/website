<?php

namespace AppBundle\Controller;

use Application\Sonata\UserBundle\Entity\User;
use Sonata\NewsBundle\Controller\PostController;
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

    public function authorWidgetAction(User $author)
    {
        $person = $this->getDoctrine()->getRepository('AppBundle:Person')->findOneBy([
            'firstName' => $author->getFirstname(),
            'lastName' => $author->getLastname()
        ]);

        return $this->render(
            '@App/News/_authorWidget.html.twig',
            [
                'author' => $person
            ]
        );
    }

    public function lastPostsWidgetAction($currentArticleId, int $articlesNumber = 3)
    {
        $articles = $this->getDoctrine()->getRepository('ApplicationSonataNewsBundle:Post')->findBy(
            [],
            [ 'publicationDateStart' => 'DESC' ],
            $articlesNumber + 1
        );

        for ($i = 0; $i < count($articles); $i++) {
            if ($articles[$i]->getId() === $currentArticleId) {
                array_splice($articles, $i, 1);
                break;
            }
        }

        $articles = array_splice($articles, 0, $articlesNumber);

        return $this->render(
            '@App/News/_lastArticlesWidget.html.twig',
            [
                'articles' => $articles
            ]
        );
    }
}
