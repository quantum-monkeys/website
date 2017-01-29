<?php

namespace AppBundle\Entity\Coaching;

use AppBundle\Interfaces\TranslatableInterface;
use Application\Sonata\MediaBundle\Entity\Media;
use Doctrine\Common\Collections\ArrayCollection;

class Service implements TranslatableInterface
{
    /**
     * @var int
     */
    protected $id;

    /**
     * @var int
     */
    protected $position;

    /**
     * @var Media
     */
    protected $picture;

    /**
     * @var Package[]
     */
    protected $packages;

    /**
     * @var float
     */
    protected $price;

    /**
     * @var ServiceTranslation[]
     */
    protected $translations;

    public function __construct()
    {
        $this->translations = new ArrayCollection();
        $this->packages = new ArrayCollection();
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
     * @return int
     */
    public function getPosition()
    {
        return $this->position;
    }

    /**
     * @param int $position
     */
    public function setPosition($position)
    {
        $this->position = $position;
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

    /**
     * @return Package[]
     */
    public function getPackages()
    {
        return $this->packages;
    }

    /**
     * @param Package[] $packages
     */
    public function setPackages($packages)
    {
        $this->packages = $packages;
    }

    /**
     * @return bool
     */
    public function hasPackage()
    {
        return count($this->packages) > 0;
    }

    /**
     * @return float
     */
    public function getPrice()
    {
        return $this->price;
    }

    /**
     * @param float $price
     */
    public function setPrice($price)
    {
        $this->price = $price;
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

