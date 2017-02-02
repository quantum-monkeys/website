<?php

namespace AppBundle\Entity\Services;

use AppBundle\Entity\Package;
use AppBundle\Interfaces\TranslatableInterface;

class ExtraDevelopmentPackage extends Package implements TranslatableInterface
{
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

