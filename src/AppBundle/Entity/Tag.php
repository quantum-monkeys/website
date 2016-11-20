<?php

namespace AppBundle\Entity;

use AppBundle\Interfaces\TranslatableInterface;
use Application\Sonata\MediaBundle\Entity\Media;
use Doctrine\Common\Collections\ArrayCollection;

class Tag implements TranslatableInterface
{
    /**
     * @var int
     */
    private $id;

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

    public function addTranslation(TagTranslation $tagTranslation)
    {
        $tagTranslation->setTag($this);
        $this->translations[] = $tagTranslation;

        return $this;
    }

    public function setTranslations($tagTranslations)
    {
        $this->translations = $tagTranslations;

        /** @var TagTranslation $translation */
        foreach ($tagTranslations as $translation) {
            $translation->setTag($this);
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

