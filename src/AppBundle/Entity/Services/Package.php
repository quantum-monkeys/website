<?php

namespace AppBundle\Entity\Services;

use AppBundle\Interfaces\TranslatableInterface;
use Doctrine\Common\Collections\ArrayCollection;

class Package implements TranslatableInterface
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
     * @var Service
     */
    protected $service;

    /**
     * @var boolean
     */
    protected $remote;

    /**
     * @var boolean
     */
    protected $onSite;

    /**
     * @var \DateTime
     */
    protected $duration;

    /**
     * @var int
     */
    protected $emergencyCalls;

    /**
     * @var int
     */
    protected $emails;

    /**
     * @var int
     */
    protected $minimalEngagement;

    /**
     * @var float
     */
    protected $price;

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
     * @return Service
     */
    public function getService()
    {
        return $this->service;
    }

    /**
     * @param Service $service
     */
    public function setService(Service $service)
    {
        $this->service = $service;
    }

    /**
     * @return boolean
     */
    public function isRemote()
    {
        return $this->remote;
    }

    /**
     * @param boolean $remote
     */
    public function setRemote(bool $remote)
    {
        $this->remote = $remote;
    }

    /**
     * @return boolean
     */
    public function isOnSite()
    {
        return $this->onSite;
    }

    /**
     * @param boolean $onSite
     */
    public function setOnSite(bool $onSite)
    {
        $this->onSite = $onSite;
    }

    /**
     * @return \DateTime
     */
    public function getDuration()
    {
        return $this->duration;
    }

    /**
     * @param \DateTime $duration
     */
    public function setDuration(\DateTime $duration)
    {
        $this->duration = $duration;
    }

    /**
     * @return int
     */
    public function getEmergencyCalls()
    {
        return $this->emergencyCalls;
    }

    /**
     * @param int $emergencyCalls
     */
    public function setEmergencyCalls(int $emergencyCalls)
    {
        $this->emergencyCalls = $emergencyCalls;
    }

    /**
     * @return int
     */
    public function getEmails()
    {
        return $this->emails;
    }

    /**
     * @param int $emails
     */
    public function setEmails(int $emails)
    {
        $this->emails = $emails;
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

