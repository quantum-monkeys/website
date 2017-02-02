<?php

namespace AppBundle\Entity\Services;

use AppBundle\Entity\Package;
use AppBundle\Interfaces\TranslatableInterface;

class DevelopmentPackage extends Package implements TranslatableInterface
{
    /**
     * @var integer
     */
    protected $seniorDevelopersCount;

    /**
     * @var integer
     */
    protected $mediumDevelopersCount;

    /**
     * @var integer
     */
    protected $juniorDevelopersCount;

    /**
     * @var integer
     */
    protected $duration;

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
    public function getSeniorDevelopersCount()
    {
        return $this->seniorDevelopersCount;
    }

    /**
     * @param int $seniorDevelopersCount
     */
    public function setSeniorDevelopersCount(int $seniorDevelopersCount)
    {
        $this->seniorDevelopersCount = $seniorDevelopersCount;
    }

    /**
     * @return int
     */
    public function getMediumDevelopersCount()
    {
        return $this->mediumDevelopersCount;
    }

    /**
     * @param int $mediumDevelopersCount
     */
    public function setMediumDevelopersCount(int $mediumDevelopersCount)
    {
        $this->mediumDevelopersCount = $mediumDevelopersCount;
    }

    /**
     * @return int
     */
    public function getJuniorDevelopersCount()
    {
        return $this->juniorDevelopersCount;
    }

    /**
     * @param int $juniorDevelopersCount
     */
    public function setJuniorDevelopersCount(int $juniorDevelopersCount)
    {
        $this->juniorDevelopersCount = $juniorDevelopersCount;
    }

    /**
     * @return int
     */
    public function getDuration()
    {
        return $this->duration;
    }

    /**
     * @param int $duration
     */
    public function setDuration(int $duration)
    {
        $this->duration = $duration;
    }

}

