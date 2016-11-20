<?php

namespace AppBundle\Traits;

use AppBundle\Entity\Trainings\Module;

trait Modulable
{
    /**
     * @var Module[]
     */
    protected $modules;

    /**
     * @return Module[]
     */
    public function getModules()
    {
        return $this->modules;
    }

    /**
     * @param Module[] $modules
     */
    public function setModules($modules)
    {
        $this->modules = $modules;
    }
}
