<?php

namespace AppBundle\Entity\Sessions;

use AppBundle\Entity\Person;
use AppBundle\Entity\Trainings\Workshop;
use AppBundle\Traits\CourseSplittable;
use AppBundle\Traits\Trainable;
use Doctrine\Common\Collections\ArrayCollection;

class WorkshopSession extends Session
{
    /**
     * @var Workshop
     */
    private $workshop;

    /**
     * @return Workshop
     */
    public function getWorkshop()
    {
        return $this->workshop;
    }

    /**
     * @param Workshop $workshop
     */
    public function setWorkshop(Workshop $workshop)
    {
        $this->workshop = $workshop;
    }
}
