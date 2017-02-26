<?php

namespace AppBundle\EventListener;

use AppBundle\Entity\EventOccurrence;
use AppBundle\Manager\MediaManager;
use AppBundle\Manager\SearchEngine;
use Presta\SitemapBundle\Sitemap\Url\GoogleImage;
use Presta\SitemapBundle\Sitemap\Url\GoogleImageUrlDecorator;
use Presta\SitemapBundle\Sitemap\Url\GoogleMultilangUrlDecorator;
use Sonata\MediaBundle\Provider\Pool;
use Symfony\Component\EventDispatcher\EventSubscriberInterface;
use Symfony\Component\Routing\Generator\UrlGeneratorInterface;
use Presta\SitemapBundle\Event\SitemapPopulateEvent;
use Presta\SitemapBundle\Sitemap\Url\UrlConcrete;

class SitemapEventsSubscriber implements EventSubscriberInterface
{
    const DEFAULT_LOCALE = 'en';
    const LOCALES = [
        self::DEFAULT_LOCALE,
        'fr'
    ];

    /**
     * @var UrlGeneratorInterface
     */
    private $urlGenerator;

    /**
     * @var SearchEngine
     */
    private $searchEngine;

    /**
     * @var MediaManager
     */
    private $mediaManager;

    /**
     * @param UrlGeneratorInterface $urlGenerator
     * @param SearchEngine $searchEngine
     * @param MediaManager $mediaManager
     */
    public function __construct(UrlGeneratorInterface $urlGenerator, SearchEngine $searchEngine, MediaManager $mediaManager)
    {
        $this->urlGenerator = $urlGenerator;
        $this->searchEngine = $searchEngine;
        $this->mediaManager = $mediaManager;
    }

    /**
     * @inheritdoc
     */
    public static function getSubscribedEvents()
    {
        return [
            SitemapPopulateEvent::ON_SITEMAP_POPULATE => 'registerEventPages',
        ];
    }

    /**
     * @param SitemapPopulateEvent $event
     */
    public function registerEventPages(SitemapPopulateEvent $event)
    {

        $eventSearch = $this->searchEngine->getEventSearch();
        /** @var EventOccurrence[] $eventOccurrences */
        $eventOccurrences = $this->searchEngine->getResults($eventSearch);

        foreach ($eventOccurrences as $eventOccurrence) {
            $urlBase = new UrlConcrete(
                $this->urlGenerator->generate(
                    'event_show',
                    [ 'id' => $eventOccurrence->getId() ],
                    UrlGeneratorInterface::ABSOLUTE_URL
                )
            );

            $urlLang = new GoogleMultilangUrlDecorator($urlBase);
            foreach (self::LOCALES as $locale) {
                $urlLang->addLink(
                    $this->urlGenerator->generate(
                        'event_show',
                        [
                            'id' => $eventOccurrence->getId(),
                            '_locale' => $locale
                        ],
                        UrlGeneratorInterface::ABSOLUTE_URL
                    ),
                    $locale
                );
            }

            $urlImage = new GoogleImageUrlDecorator($urlLang);
            $urlImage->addImage(new GoogleImage($this->mediaManager->getPublicPath($eventOccurrence->getPicture(), 'event_big')));

            $event->getUrlContainer()->addUrl($urlImage, 'events');
        }
    }
}
