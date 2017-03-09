<?php

namespace AppBundle\Entity;

use Application\Sonata\MediaBundle\Entity\Media;

class LandingPageTranslation
{
    /**
     * @var int
     */
    private $id;

    /**
     * @var string
     */
    private $locale;

    /**
     * @var LandingPage
     */
    private $landingPage;

    /**
     * @var string
     */
    protected $title;

    /**
     * @var string
     */
    protected $slug;

    /**
     * @var string
     */
    protected $intro;

    /**
     * @var string
     */
    protected $submitButtonLabel;

    /**
     * @var string
     */
    protected $formTitle;

    /**
     * @var Media
     */
    private $picture;

    /**
     * Get id
     *
     * @return int
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @return string
     */
    public function getLocale()
    {
        return $this->locale;
    }

    /**
     * @param string $locale
     */
    public function setLocale(string $locale)
    {
        $this->locale = $locale;
    }

    /**
     * @return LandingPage
     */
    public function getLandingPage()
    {
        return $this->landingPage;
    }

    /**
     * @param LandingPage $landingPage
     */
    public function setLandingPage($landingPage)
    {
        $this->landingPage = $landingPage;
    }

    /**
     * @return string
     */
    public function getTitle()
    {
        return $this->title;
    }

    /**
     * @param string $title
     */
    public function setTitle($title)
    {
        $this->title = $title;
    }

    /**
     * @return string
     */
    public function getSlug()
    {
        return $this->slug;
    }

    /**
     * @param string $slug
     */
    public function setSlug($slug)
    {
        $this->slug = $slug;
    }

    /**
     * @return string
     */
    public function getIntro()
    {
        return $this->intro;
    }

    /**
     * @param string $intro
     */
    public function setIntro($intro)
    {
        $this->intro = $intro;
    }

    /**
     * @return string
     */
    public function getSubmitButtonLabel()
    {
        return $this->submitButtonLabel;
    }

    /**
     * @param string $submitButtonLabel
     */
    public function setSubmitButtonLabel($submitButtonLabel)
    {
        $this->submitButtonLabel = $submitButtonLabel;
    }

    /**
     * @return string
     */
    public function getFormTitle()
    {
        return $this->formTitle;
    }

    /**
     * @param string $formTitle
     */
    public function setFormTitle($formTitle)
    {
        $this->formTitle = $formTitle;
    }

    /**
     * @return Media
     */
    public function getPicture()
    {
        return $this->picture;
    }

    /**
     * @param Media $picture
     */
    public function setPicture($picture)
    {
        $this->picture = $picture;
    }
}

