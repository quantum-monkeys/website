<?php

namespace AppBundle\Entity\Sessions;

use AppBundle\Entity\Person;
use AppBundle\Traits\CourseSplittable;
use Doctrine\Common\Collections\ArrayCollection;

abstract class Session
{
    use CourseSplittable;

    /**
     * @var int
     */
    protected $id;

    /**
     * @var string
     */
    protected $language;

    public function __construct()
    {
        $this->courses = new ArrayCollection();
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
     * @return string
     */
    public function getLanguage()
    {
        return $this->language;
    }

    /**
     * @param string $language
     */
    public function setLanguage(string $language)
    {
        $this->language = $language;
    }

    /**
     * @return Person[]
     */
    public function getTrainers()
    {
        $trainers = [];

        foreach ($this->courses as $course) {
            foreach ($course->getTrainers() as $trainer) {
                $trainers[$trainer->getId()] = $trainer;
            }
        }

        return $trainers;
    }
}
