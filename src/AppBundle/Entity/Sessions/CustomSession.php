<?php

namespace AppBundle\Entity\Sessions;

use AppBundle\Entity\Person;
use AppBundle\Entity\Trainings\Workshop;
use AppBundle\Traits\CourseSplittable;
use AppBundle\Traits\Modulable;
use Doctrine\Common\Collections\ArrayCollection;

class CustomSession extends Session
{
    use Modulable;

    public function __construct()
    {
        $this->modules = new ArrayCollection();
    }
}
