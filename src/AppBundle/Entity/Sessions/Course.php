<?php

namespace AppBundle\Entity\Sessions;

use AppBundle\Traits\Modulable;
use AppBundle\Traits\Trainable;
use Doctrine\Common\Collections\ArrayCollection;

class Course
{
    use Modulable;
    use Trainable;

    /**
     * @var int
     */
    protected $id;

    /**
     * @var \DateTime
     */
    protected $begin;

    /**
     * @var \DateTime
     */
    protected $end;

    /**
     * @var Session[]
     */
    protected $sessions;

    /**
     * Course constructor.
     */
    public function __construct()
    {
        $this->trainers = new ArrayCollection();
        $this->modules = new ArrayCollection();
        $this->sessions = new ArrayCollection();
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
     * @return \DateTime
     */
    public function getBegin()
    {
        return $this->begin;
    }

    /**
     * @param \DateTime $begin
     */
    public function setBegin(\DateTime $begin)
    {
        $this->begin = $begin;
    }

    /**
     * @return \DateTime
     */
    public function getEnd()
    {
        return $this->end;
    }

    /**
     * @param \DateTime $end
     */
    public function setEnd(\DateTime $end)
    {
        $this->end = $end;
    }

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
}
