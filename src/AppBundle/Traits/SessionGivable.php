<?php

namespace AppBundle\Traits;

use AppBundle\Entity\Person;
use AppBundle\Entity\Sessions\Session;

trait SessionGivable
{
    /**
     * @var Session[]
     */
    protected $sessions;

    /**
     * @return Session[]
     */
    public function getSessions()
    {
        return $this->sessions;
    }

    /**
     * @param Session[] $sessions
     */
    public function setSessions($sessions)
    {
        $this->sessions = $sessions;
    }

    /**
     * @return Person[]
     */
    public function getTrainers()
    {
        $trainers = [];

        foreach ($this->getSessions() as $session) {
            foreach ($session->getTrainers() as $trainer) {
                $trainers[$trainer->getId()] = $trainer;
            }
        }

        return $trainers;
    }
}
