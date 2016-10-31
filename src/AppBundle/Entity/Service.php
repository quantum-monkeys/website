<?php

namespace AppBundle\Entity;

use Application\Sonata\MediaBundle\Entity\Media;
use Doctrine\Common\Collections\ArrayCollection;

class Service
{
    /**
     * @var int
     */
    private $id;

    /**
     * @var Media
     */
    private $picture;

    /**
     * @var ServiceTranslation[]
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

    /**
     * Set name
     *
     * @param string $name
     *
     * @return Service
     */
    public function setName($name)
    {
        $this->name = $name;

        return $this;
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
    public function setPicture(Media $picture)
    {
        $this->picture = $picture;
    }


    public function addTranslation(ServiceTranslation $serviceTranslation)
    {
        $serviceTranslation->setService($this);
        $this->translations[] = $serviceTranslation;

        return $this;
    }

    public function setTranslations($serviceTranslations)
    {
        $this->translations = $serviceTranslations;

        /** @var ServiceTranslation $translation */
        foreach ($serviceTranslations as $translation) {
            $translation->setService($this);
        }
    }

    public function getTranslations()
    {
        return $this->translations;
    }

    public function getName()
    {
        if ($this->getTranslations()->count() === 0) {
            return "Not translated";
        }

        foreach ($this->getTranslations() as $translation) {
            if ($translation->getLocale() === 'en') {
                return $translation->getName();
            }
        }

        return $this->getTranslations()->first()->getName();
    }

    public function __toString()
    {
        return $this->getName();
    }
}

