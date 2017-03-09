<?php

namespace AppBundle\Entity;

use AppBundle\Interfaces\TranslatableInterface;
use Doctrine\Common\Collections\ArrayCollection;

class LandingPage implements TranslatableInterface
{
    /**
     * @var int
     */
    private $id;

    /**
     * @var LandingPageTranslation[]
     */
    private $translations;

    public function __construct()
    {
        $this->translations = new ArrayCollection();
    }

    /**
     * Get id
     *
     * @return int
     */
    public function getId()
    {
        return $this->id;
    }

    public function addTranslation(LandingPageTranslation $landingPageTranslation)
    {
        $landingPageTranslation->setLandingPage($this);
        $this->translations[] = $landingPageTranslation;

        return $this;
    }

    public function setTranslations($landingPageTranslations)
    {
        $this->translations = $landingPageTranslations;

        /** @var LandingPageTranslation $translation */
        foreach ($landingPageTranslations as $translation) {
            $translation->setLandingPage($this);
        }
    }

    public function getTranslations()
    {
        return $this->translations;
    }

    public function getTitle()
    {
        if ($this->getTranslations()->count() === 0) {
            return "Not translated";
        }

        foreach ($this->getTranslations() as $translation) {
            if ($translation->getLocale() === 'en') {
                return $translation->getTitle();
            }
        }

        return $this->getTranslations()->first()->getTitle();
    }

    public function __toString()
    {
        return $this->getTitle();
    }
}

