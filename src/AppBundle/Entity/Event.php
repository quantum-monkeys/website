<?php

namespace AppBundle\Entity;

use AppBundle\Interfaces\TranslatableInterface;
use Application\Sonata\MediaBundle\Entity\Media;
use Doctrine\Common\Collections\ArrayCollection;

/**
 * Event
 */
abstract class Event implements TranslatableInterface
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
     * @var EventTranslation[]
     */
    private $translations;

    public function __construct()
    {
        $this->translations = new ArrayCollection();
    }

    public function getId() : int
    {
        return $this->id;
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

    public function addTranslation(EventTranslation $eventTranslation)
    {
        $eventTranslation->setEvent($this);
        $this->translations[] = $eventTranslation;

        return $this;
    }

    public function setTranslations($eventTranslations)
    {
        $this->translations = $eventTranslations;

        /** @var EventTranslation $translation */
        foreach ($eventTranslations as $translation) {
            $translation->setEvent($this);
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

