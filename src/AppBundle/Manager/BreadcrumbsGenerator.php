<?php

namespace AppBundle\Manager;

use AppBundle\Entity\EventOccurrence;
use AppBundle\Entity\Person;
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
        $this->breadcrumbs->addItem('services', 'services');
    }

    public function generateCoaching()
    {
        $this->generateHomepage();
        $this->breadcrumbs->addItem('coaching', 'coaching');
    }

    public function generateNewsletter()
    {
        $this->generateHomepage();
        $this->breadcrumbs->addItem('newsletter', 'newsletter');
    }

    public function generateAcademy()
    {
        $this->generateHomepage();
        $this->breadcrumbs->addRouteItem('academy', 'academy');
    }

    public function generateStudio()
    {
        $this->generateHomepage();
        $this->breadcrumbs->addRouteItem('studio', 'studio');
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
        $this->breadcrumbs->addRouteItem('blog', 'blog');
    }

    public function generateBlogAuthor(Person $author)
    {
        $this->generateBlog();
        $this->breadcrumbs->addRouteItem($author->getDisplayName(), 'blog_author', [
            'slug' => $author->getSlug()
        ]);
    }

    public function generateBlogPost(Post $post)
    {
        $this->generateBlog();
        $this->breadcrumbs->addItem($post->getTitle());
    }
}
