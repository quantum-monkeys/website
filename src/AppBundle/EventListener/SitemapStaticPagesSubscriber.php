<?php

namespace AppBundle\EventListener;

use Application\Sonata\NewsBundle\Entity\Post;
use Doctrine\Common\Persistence\ObjectManager;
use Presta\SitemapBundle\Sitemap\Url\GoogleImage;
use Presta\SitemapBundle\Sitemap\Url\GoogleImageUrlDecorator;
use Presta\SitemapBundle\Sitemap\Url\GoogleMultilangUrlDecorator;
use Presta\SitemapBundle\Sitemap\Url\GoogleNewsUrlDecorator;
use Sonata\NewsBundle\Model\BlogInterface;
use Sonata\NewsBundle\Model\PostManagerInterface;
use Symfony\Component\EventDispatcher\EventSubscriberInterface;
use Symfony\Component\Routing\Generator\UrlGeneratorInterface;
use Presta\SitemapBundle\Event\SitemapPopulateEvent;
use Presta\SitemapBundle\Sitemap\Url\UrlConcrete;

class SitemapStaticPagesSubscriber implements EventSubscriberInterface
{
    const DEFAULT_LOCALE = 'en';
    const LOCALES = [
        self::DEFAULT_LOCALE,
        'fr'
    ];

    const ROUTES = [
        'homepage',
        'services_index',
        'coaching',
        'academy',
        'studio',
        'event_list',
        'about_us',
        'blog',
        'newsletter',
    ];

    /**
     * @var UrlGeneratorInterface
     */
    private $urlGenerator;

    /**
     * @param UrlGeneratorInterface $urlGenerator
     */
    public function __construct(UrlGeneratorInterface $urlGenerator)
    {
        $this->urlGenerator = $urlGenerator;
    }

    /**
     * @inheritdoc
     */
    public static function getSubscribedEvents()
    {
        return [
            SitemapPopulateEvent::ON_SITEMAP_POPULATE => 'registerStaticPages',
        ];
    }

    /**
     * @param SitemapPopulateEvent $event
     */
    public function registerStaticPages(SitemapPopulateEvent $event)
    {
        foreach (self::ROUTES as $route) {
            $urlLang = $this->registerStaticPage($route);
            $event->getUrlContainer()->addUrl($urlLang, 'default');
        }
    }

    public function registerStaticPage(string $route): GoogleMultilangUrlDecorator
    {
        $urlBase = new UrlConcrete($this->urlGenerator->generate($route, [], UrlGeneratorInterface::ABSOLUTE_URL));

        $urlLang = new GoogleMultilangUrlDecorator($urlBase);

        foreach (self::LOCALES as $locale) {
            $urlLang->addLink($this->urlGenerator->generate($route, [ '_locale' => $locale ], UrlGeneratorInterface::ABSOLUTE_URL), $locale);
        }

        return $urlLang;
    }
}
