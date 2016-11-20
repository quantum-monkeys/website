<?php

namespace AppBundle\Entity\Trainings;

use AppBundle\Traits\Modulable;
use AppBundle\Traits\SessionGivable;
use Doctrine\Common\Collections\ArrayCollection;

class LearningPath extends Training
{
    use SessionGivable;
    use Modulable;

    public function __construct()
    {
        parent::__construct();
        $this->modules = new ArrayCollection();
        $this->sessions = new ArrayCollection();
    }
}
