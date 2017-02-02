<?php

namespace AppBundle\Entity;

use AppBundle\Interfaces\TranslatableInterface;
use Doctrine\Common\Collections\ArrayCollection;

abstract class Package implements TranslatableInterface
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
     * @var int
     */
    protected $minimalEngagement;

    /**
     * @var float
     */
    protected $price;

    /**
     * @var PackageTranslation[]
     */
    protected $translations;

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
     * @return int
     */
    public function getMinimalEngagement()
    {
        return $this->minimalEngagement;
    }

    /**
     * @param int $minimalEngagement
     */
    public function setMinimalEngagement(int $minimalEngagement)
    {
        $this->minimalEngagement = $minimalEngagement;
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
    public function setPrice(float $price)
    {
        $this->price = $price;
    }

    public function addTranslation(PackageTranslation $packageTranslation)
    {
        $packageTranslation->setPackage($this);
        $this->translations[] = $packageTranslation;

        return $this;
    }

    public function setTranslations($packageTranslations)
    {
        $this->translations = $packageTranslations;

        /** @var PackageTranslation $translation */
        foreach ($packageTranslations as $translation) {
            $translation->setPackage($this);
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

