<?php

namespace AppBundle\Entity\Trainings;

use AppBundle\Traits\SessionGivable;
use Doctrine\Common\Collections\ArrayCollection;

class Workshop extends Training
{
    use SessionGivable;

    public function __construct()
    {
        parent::__construct();
        $this->sessions = new ArrayCollection();
    }
}
