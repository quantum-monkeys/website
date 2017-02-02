<?php

namespace AppBundle\Entity\Services;

use AppBundle\Entity\Package;
use AppBundle\Interfaces\TranslatableInterface;

class CoachingPackage extends Package implements TranslatableInterface
{
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
     * Get id
     *
     * @return int
     */
    public function getId()
    {
        return $this->id;
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
}

