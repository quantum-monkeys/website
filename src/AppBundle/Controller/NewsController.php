<?php

namespace AppBundle\Controller;

use AppBundle\Entity\Person;
use Doctrine\ORM\Query;
use Sonata\NewsBundle\Controller\PostController;
use Sonata\NewsBundle\Model\PostManagerInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\ParamConverter;

class NewsController extends PostController
{
    public function indexAction(Request $request = null)
    {
        $this->get('app.manager.breadcrumb_generator')->generateBlog();

        $pager = $this->getPostManager()->getPager(
            [],
            $request->get('page', 1)
        );

        return $this->renderBlogList($pager, $request);
    }

    /**
     * @ParamConverter("author", class="AppBundle:Person")
     *
     * @param Person $author
     * @param Request|null $request
     *
     * @return Response
     */
    public function authorAction(Person $author, Request $request = null)
    {
        $this->get('app.manager.breadcrumb_generator')->generateBlogAuthor($author);

        $pager = $this->getPostManager()->getPager(
            [
                'author' => $author->getId()
            ],
            $request->get('page', 1)
        );

        return $this->renderBlogList($pager, $request);
    }

    protected function renderBlogList($pager, Request $request = null)
    {
        $parameters = [
            'pager' => $pager,
            'blog' => $this->getBlog(),
            'tag' => false,
            'collection' => false,
            'route' => $request->get('_route'),
            'route_parameters' => $request->get('_route_params'),
        ];

        $response = $this->render('AppBundle:News:list.html.twig', $parameters);

        return $response;
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

    public function feedAction(Request $request)
    {
        $lang = $request->get('lang', null);

        $criteria = [];
        if ($lang) {
            $criteria['lang'] = $lang;
        }

        $articles = $this->getDoctrine()->getRepository('ApplicationSonataNewsBundle:Post')->findBy(
            $criteria,
            [ 'publicationDateStart' => 'DESC' ]
        );

        $feed = $this->get('eko_feed.feed.manager')->get('article');
        $feed->addFromArray($articles);

        return new Response($feed->render('rss'));
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

    public function contributorsWidgetAction()
    {
        $queryBuilder = $this->getDoctrine()->getRepository('AppBundle:Person')->createQueryBuilder('a');
        $queryBuilder
            ->select('a')
            ->innerJoin('ApplicationSonataNewsBundle:Post', 'p', 'WITH', 'a.id = p.author')
            ->addGroupBy('a.id')
        ;

        $query = $queryBuilder->getQuery()->setHydrationMode(Query::HYDRATE_OBJECT);
        $authors = $query->getResult();

        return $this->render(
            '@App/News/_contributorsWidget.html.twig',
            [
                'authors' => $authors
            ]
        );
    }

    /**
     * @return PostManagerInterface
     */
    protected function getPostManager()
    {
        return $this->get('sonata.news.custom.post_manager');
    }
}
