<?php

namespace AppBundle\EventListener;

use AppBundle\Manager\MediaManager;
use Application\Sonata\NewsBundle\Entity\Post;
use Doctrine\Common\Persistence\ObjectManager;
use Presta\SitemapBundle\Sitemap\Url\GoogleImage;
use Presta\SitemapBundle\Sitemap\Url\GoogleImageUrlDecorator;
use Presta\SitemapBundle\Sitemap\Url\GoogleNewsUrlDecorator;
use Sonata\NewsBundle\Model\BlogInterface;
use Sonata\NewsBundle\Model\PostManagerInterface;
use Symfony\Component\EventDispatcher\EventSubscriberInterface;
use Symfony\Component\Routing\Generator\UrlGeneratorInterface;
use Presta\SitemapBundle\Event\SitemapPopulateEvent;
use Presta\SitemapBundle\Sitemap\Url\UrlConcrete;

class SitemapBlogPostSubscriber implements EventSubscriberInterface
{
    /**
     * @var UrlGeneratorInterface
     */
    private $urlGenerator;

    /**
     * @var ObjectManager
     */
    private $manager;

    /**
     * @var BlogInterface
     */
    private $blog;

    /**
     * @var MediaManager
     */
    private $mediaManager;

    /**
     * @param UrlGeneratorInterface $urlGenerator
     * @param PostManagerInterface $manager
     * @param BlogInterface $blog
     * @param MediaManager $mediaManager
     */
    public function __construct(UrlGeneratorInterface $urlGenerator, PostManagerInterface $manager, BlogInterface $blog, MediaManager $mediaManager)
    {
        $this->urlGenerator = $urlGenerator;
        $this->manager = $manager;
        $this->blog = $blog;
        $this->mediaManager = $mediaManager;
    }

    /**
     * @inheritdoc
     */
    public static function getSubscribedEvents()
    {
        return [
            SitemapPopulateEvent::ON_SITEMAP_POPULATE => 'registerBlogPostsPages',
        ];
    }

    /**
     * @param SitemapPopulateEvent $event
     */
    public function registerBlogPostsPages(SitemapPopulateEvent $event)
    {
        /** @var Post[] $posts */
        $posts = $this->manager->findAll();

        foreach ($posts as $post) {
            $urlBase = new UrlConcrete(
                $this->urlGenerator->generate(
                    'blog_view',
                    [ 'permalink' => $this->blog->getPermalinkGenerator()->generate($post) ],
                    UrlGeneratorInterface::ABSOLUTE_URL
                )
            );

            $urlImage = new GoogleImageUrlDecorator($urlBase);
            $urlImage->addImage(new GoogleImage($this->mediaManager->getPublicPath($post->getImage(), 'wide')));

            $newsUrl = new GoogleNewsUrlDecorator($urlImage, 'Quantum Monkeys Blog', 'en', $post->getPublicationDateStart(), $post->getTitle());

            $event->getUrlContainer()->addUrl($newsUrl, 'blog');
        }
    }
}
