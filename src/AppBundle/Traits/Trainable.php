<?php

namespace AppBundle\Traits;

use AppBundle\Entity\Person;

trait Trainable
{
    /**
     * @var Person[]
     */
    protected $trainers;

    /**
     * @return Person[]
     */
    public function getTrainers()
    {
        return $this->trainers;
    }

    /**
     * @param Person[] $trainers
     */
    public function setTrainers($trainers)
    {
        $this->trainers = $trainers;
    }
}
