<?php

namespace AppBundle\Traits;

use AppBundle\Entity\Person;
use AppBundle\Entity\Sessions\Course;

trait CourseSplittable
{
    /**
     * @var Course[]
     */
    protected $courses;

    /**
     * @return Course[]
     */
    public function getCourses()
    {
        return $this->courses;
    }

    /**
     * @param Course[] $courses
     */
    public function setCourses($courses)
    {
        $this->courses = $courses;
    }

    public function addCourse(Course $course)
    {
        $this->courses[] = $course;
    }

    /**
     * @return Person[]
     */
    public function getTrainers()
    {
        $trainers = [];

        foreach ($this->getCourses() as $course) {
            foreach ($course->getTrainers() as $trainer) {
                $trainers[$trainer->getId()] = $trainer;
            }
        }

        return $trainers;
    }

    public function getBegin()
    {
        $beginning = null;
        foreach ($this->courses as $course) {
            if ($beginning === null || $course->getBegin() < $beginning) {
                $beginning = $course->getBegin();
            }
        }
        return $beginning;
    }

    public function getEnd()
    {
        $end = null;
        foreach ($this->courses as $course) {
            if ($end === null || $course->getEnd() > $end) {
                $end = $course->getEnd();
            }
        }
        return $end;
    }
}
