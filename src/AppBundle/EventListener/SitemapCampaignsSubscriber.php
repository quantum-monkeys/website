<?php

namespace AppBundle\EventListener;

use AppBundle\Entity\EventOccurrence;
use AppBundle\Entity\Marketing\Campaign;
use AppBundle\Manager\MediaManager;
use AppBundle\Manager\SearchEngine;
use Doctrine\Common\Persistence\ObjectManager;
use Presta\SitemapBundle\Sitemap\Url\GoogleImage;
use Presta\SitemapBundle\Sitemap\Url\GoogleImageUrlDecorator;
use Presta\SitemapBundle\Sitemap\Url\GoogleMultilangUrlDecorator;
use Sonata\MediaBundle\Provider\Pool;
use Symfony\Component\EventDispatcher\EventSubscriberInterface;
use Symfony\Component\Routing\Generator\UrlGeneratorInterface;
use Presta\SitemapBundle\Event\SitemapPopulateEvent;
use Presta\SitemapBundle\Sitemap\Url\UrlConcrete;

class SitemapCampaignsSubscriber implements EventSubscriberInterface
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
     * @var ObjectManager
     */
    private $objectManager;

    /**
     * @var MediaManager
     */
    private $mediaManager;

    /**
     * @param UrlGeneratorInterface $urlGenerator
     * @param ObjectManager $objectManager
     * @param MediaManager $mediaManager
     */
    public function __construct(UrlGeneratorInterface $urlGenerator, ObjectManager $objectManager, MediaManager $mediaManager)
    {
        $this->urlGenerator = $urlGenerator;
        $this->objectManager = $objectManager;
        $this->mediaManager = $mediaManager;
    }

    /**
     * @inheritdoc
     */
    public static function getSubscribedEvents()
    {
        return [
            SitemapPopulateEvent::ON_SITEMAP_POPULATE => 'registerCampaignPages',
        ];
    }

    /**
     * @param SitemapPopulateEvent $event
     */
    public function registerCampaignPages(SitemapPopulateEvent $event)
    {
        /** @var Campaign[] $campaigns */
        $campaigns = $this->objectManager->getRepository('AppBundle:Marketing\Campaign')->findAll();

        foreach ($campaigns as $campaign) {
            foreach ($campaign->getTranslations() as $campaignTranslation) {
                $urlBase = new UrlConcrete(
                    $this->urlGenerator->generate(
                        'campaign',
                        [ 'slug' => $campaignTranslation->getSlug(), '_locale' => $campaignTranslation->getLocale() ],
                        UrlGeneratorInterface::ABSOLUTE_URL
                    )
                );

                $urlImage = new GoogleImageUrlDecorator($urlBase);
                $urlImage->addImage(new GoogleImage($this->mediaManager->getPublicPath($campaignTranslation->getMainPicture(), 'landing_page_main')));

                $event->getUrlContainer()->addUrl($urlImage, 'default');
            }
        }
    }
}
