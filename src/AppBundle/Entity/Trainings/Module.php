<?php

namespace AppBundle\Entity\Trainings;

use AppBundle\Interfaces\TranslatableInterface;
use Application\Sonata\MediaBundle\Entity\Media;
use Doctrine\Common\Collections\ArrayCollection;

class Module implements TranslatableInterface
{
    /**
     * @var int
     */
    private $id;

    /**
     * @var LearningPath
     */
    private $learningPath;

    /**
     * @var ModuleTranslation[]
     */
    private $translations;

    public function __construct()
    {
        $this->translations = new ArrayCollection();
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
     * @return LearningPath
     */
    public function getLearningPath()
    {
        return $this->learningPath;
    }

    /**
     * @param LearningPath $learningPath
     */
    public function setLearningPath(LearningPath $learningPath)
    {
        $this->learningPath = $learningPath;
    }

    public function addTranslation(ModuleTranslation $moduleTranslation)
    {
        $moduleTranslation->setModule($this);
        $this->translations[] = $moduleTranslation;

        return $this;
    }

    public function setTranslations($moduleTranslations)
    {
        $this->translations = $moduleTranslations;

        /** @var ModuleTranslation $translation */
        foreach ($moduleTranslations as $translation) {
            $translation->setModule($this);
        }
    }

    public function getTranslations()
    {
        return $this->translations;
    }

    public function getName()
    {
        if ($this->getTranslations()->count() === 0) {
            return "Not translated";
        }

        foreach ($this->getTranslations() as $translation) {
            if ($translation->getLocale() === 'en') {
                return $translation->getName();
            }
        }

        return $this->getTranslations()->first()->getName();
    }

    public function __toString()
    {
        return $this->getName();
    }
}

