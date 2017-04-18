<?php

namespace AppBundle\EventListener;

use AppBundle\Manager\MediaManager;
use AppBundle\Manager\ObjectTranslator;
use Application\Sonata\NewsBundle\Document\Post;
use Doctrine\Common\Persistence\ObjectManager;
use Sonata\NewsBundle\Model\BlogInterface;
use Sonata\NewsBundle\Model\PostManagerInterface;
use Sonata\SeoBundle\Seo\SeoPage;
use Symfony\Bundle\FrameworkBundle\Templating\Helper\AssetsHelper;
use Symfony\Component\EventDispatcher\EventSubscriberInterface;
use Symfony\Component\HttpFoundation\RequestStack;
use Symfony\Component\HttpKernel\KernelEvents;
use Symfony\Component\Routing\Generator\UrlGeneratorInterface;
use Symfony\Component\Translation\TranslatorInterface;

class MetadataSubscriber implements EventSubscriberInterface
{
    protected $requestStack;
    protected $translator;
    protected $urlGenerator;
    protected $assetsHelper;
    protected $page;
    protected $objectManager;
    protected $objectTranslator;
    protected $mediaManager;
    protected $postManager;
    protected $blog;

    public function __construct(RequestStack $requestStack, TranslatorInterface $translator,
                                UrlGeneratorInterface $urlGenerator, AssetsHelper $assetsHelper,
                                SeoPage $page, ObjectManager $objectManager,
                                ObjectTranslator $objectTranslator, MediaManager $mediaManager,
                                PostManagerInterface $postManager, BlogInterface $blog)
    {
        $this->requestStack = $requestStack;
        $this->translator = $translator;
        $this->urlGenerator = $urlGenerator;
        $this->assetsHelper = $assetsHelper;
        $this->page = $page;
        $this->objectManager = $objectManager;
        $this->objectTranslator = $objectTranslator;
        $this->mediaManager = $mediaManager;
        $this->postManager = $postManager;
        $this->blog = $blog;
    }

    /**
     * @inheritdoc
     */
    public static function getSubscribedEvents()
    {
        return [
            KernelEvents::REQUEST => 'replaceMetadatas',
        ];
    }

    public function replaceMetadatas()
    {
        if ($this->requestStack->getParentRequest() == null) {
            switch ($this->requestStack->getMasterRequest()->get('_route')) {
                case 'homepage':
                    $this->generateGenericMetadatas('home');
                    $this->generateGenericUrlMetadatas('homepage');
                    break;
                case 'about_us':
                    $this->generateGenericMetadatas('about');
                    $this->generateGenericUrlMetadatas('about_us');
                    break;
                case 'services':
                    $this->generateGenericMetadatas('services');
                    $this->generateGenericUrlMetadatas('services');
                    break;
                case 'studio':
                    $this->generateGenericMetadatas('studio');
                    $this->generateGenericUrlMetadatas('studio');
                    $this->setImage($this->assetsHelper->getUrl('logos/QM-Studio.png'), true);
                    break;
                case 'academy':
                    $this->generateGenericMetadatas('academy');
                    $this->generateGenericUrlMetadatas('academy');
                    $this->setImage($this->assetsHelper->getUrl('logos/QM-Academie.png'), true);
                    break;
                case 'event_list':
                    $this->generateGenericMetadatas('events');
                    $this->generateGenericUrlMetadatas('event_list');
                    break;
                case 'event_show':
                    $this->generateEventMetadatas($this->requestStack->getCurrentRequest()->attributes->get('id'));
                    break;
                case 'campaign':
                case 'campaign_success':
                case 'campaign_contact':
                case 'campaign_contact_success':
                    $this->generateCampaignMetadatas(
                        $this->requestStack->getCurrentRequest()->attributes->get('slug')
                    );
                    break;
                case 'blog':
                    $this->generateGenericMetadatas('blog');
                    $this->generateGenericUrlMetadatas('blog');
                    break;
                case 'blog_view':
                    $this->generateArticleMetadatas(
                        $this->requestStack->getCurrentRequest()->attributes->get('permalink')
                    );
                    $this->page->addMeta('property', 'twitter:card', 'summary_large_image');
                    break;
                default:
                    $this->generateGenericMetadatas('home');
            }
        }
    }

    protected function generateGenericMetadatas($translationDomain)
    {
        $this->setTitle($this->translator->trans('meta.title', [], $translationDomain));
        $this->setDescription($this->translator->trans('meta.description', [], $translationDomain));
        $this->setImage($this->assetsHelper->getUrl('logos/QM-Generic.png'), true);
        $this->page->addMeta('name', 'keywords', $this->translator->trans('meta.keywords', [], $translationDomain));
    }

    protected function generateEventMetadatas($eventId)
    {
        if ($eventId !== null) {
            $eventOccurrence = $this->objectManager->getRepository('AppBundle:EventOccurrence')->findOneBy(
                ['id' => $eventId]
            );
            $this->setTitle($this->objectTranslator->translate($eventOccurrence, 'name').' - Quantum Monkeys');
            $this->setDescription($this->objectTranslator->translate($eventOccurrence, 'description'));

            $this->setImage($this->mediaManager->getPublicPath($eventOccurrence->getPicture(), 'event_big'));
        }
    }

    protected function generateArticleMetadatas($permalink)
    {
        /** @var Post $post */
        $post = $this->postManager->findOneByPermalink($permalink, $this->blog);

        $this->setTitle($post->getTitle() . ' - Quantum Monkeys');
        $this->setDescription($post->getAbstract());

        $this->setImage($this->mediaManager->getPublicPath($post->getImage(), 'wide'));
    }

    protected function generateCampaignMetadatas($campaignSlug)
    {
        if ($campaignSlug !== null) {
            $campaignTranslation = $this->objectManager->getRepository('AppBundle:Marketing\CampaignTranslation')->findOneBy(
                ['slug' => $campaignSlug]
            );
            $this->setTitle($campaignTranslation->getMetaTitle() . ' - Quantum Monkeys');
            $this->setDescription($campaignTranslation->getMetaDescription());
            $this->setKeywords($campaignTranslation->getMetaKeywords());

            $this->setImage($this->mediaManager->getPublicPath($campaignTranslation->getMainPicture(), 'landing_page_main'));
        }
    }

    protected function generateGenericUrlMetadatas(string $route)
    {
        $this->page->addMeta('property', 'og:url', $this->urlGenerator->generate($route, [], UrlGeneratorInterface::ABSOLUTE_URL));
    }

    protected function setTitle(string $title)
    {
        $this->page->setTitle($title);
        $this->page->addMeta('property', 'og:title', $title);
        $this->page->addMeta('property', 'twitter:title', $title);
    }

    protected function setDescription(string $description = null)
    {
        $this->page->addMeta('name', 'description', $description);
        $this->page->addMeta('property', 'og:description', $description);
        $this->page->addMeta('property', 'twitter:description', $description);
    }

    protected function setKeywords(string $keywords = null)
    {
        $this->page->addMeta('name', 'keywords', $keywords);
    }

    protected function setImage(string $path, bool $absolute = false)
    {
        if ($absolute) {
            $path = $this->getAbsoluteUrl($path);
        }

        $this->page->addMeta('property', 'og:image', $path);
        $this->page->addMeta('property', 'twitter:image', $path);
    }

    protected function getAbsoluteUrl(string $relativeUrl): string
    {
        $currentRequest = $this->requestStack->getCurrentRequest();
        return $currentRequest->getScheme() . '://' . $currentRequest->getHttpHost() . $relativeUrl;
    }
}
