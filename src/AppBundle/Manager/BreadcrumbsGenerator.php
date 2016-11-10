<?php

namespace AppBundle\Manager;

use AppBundle\Entity\EventOccurrence;
use Application\Sonata\NewsBundle\Entity\Post;
use WhiteOctober\BreadcrumbsBundle\Model\Breadcrumbs;

class BreadcrumbsGenerator
{
    /**
     * @var Breadcrumbs
     */
    protected $breadcrumbs;

    /**
     * @var ObjectTranslator
     */
    protected $objectTranslator;

    public function __construct(Breadcrumbs $breadcrumbs, ObjectTranslator $objectTranslator)
    {
        $this->breadcrumbs = $breadcrumbs;
        $this->objectTranslator = $objectTranslator;
    }

    public function generateHomepage()
    {
        $this->breadcrumbs->addRouteItem('home', 'homepage');
    }

    public function generateServices()
    {
        $this->generateHomepage();
        $this->breadcrumbs->addItem('services', 'service_list');
    }

    public function generateTrainings()
    {
        $this->generateHomepage();
        $this->breadcrumbs->addRouteItem('trainings', 'training_list');
    }

    public function generateEvents()
    {
        $this->generateHomepage();
        $this->breadcrumbs->addRouteItem('events', 'event_list');
    }

    public function generateEvent(EventOccurrence $eventOccurrence)
    {
        $this->generateEvents();
        $this->breadcrumbs->addRouteItem(
            $this->objectTranslator->translate($eventOccurrence, 'name') ?? $this->objectTranslator->translate($eventOccurrence->getEvent(), 'name'),
            'event_show',
            [
                'id' => $eventOccurrence->getId(),
            ]
        );
    }

    public function generateAboutUs()
    {
        $this->generateHomepage();
        $this->breadcrumbs->addRouteItem('about_us', 'about_us');
    }

    public function generateBlog()
    {
        $this->generateHomepage();
        $this->breadcrumbs->addRouteItem('blog', 'sonata_news_home');
    }

    public function generateBlogPost(Post $post)
    {
        $this->generateBlog();
        $this->breadcrumbs->addItem($post->getTitle());
    }
}
