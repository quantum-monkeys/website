<?php

namespace AppBundle\Entity\Services;

use AppBundle\Entity\PackageTranslation;

class ExtraDevelopmentPackageTranslation extends PackageTranslation
{
    /**
     * @var string
     */
    protected $profile;

    /**
     * @return string
     */
    public function getProfile()
    {
        return $this->profile;
    }

    /**
     * @param string $profile
     */
    public function setProfile(string $profile)
    {
        $this->profile = $profile;
    }


}

