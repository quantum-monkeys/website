<?php

namespace AppBundle\Entity\Sessions;

use AppBundle\Entity\Trainings\LearningPath;

class LearningPathSession extends Session
{
    /**
     * @var LearningPath
     */
    private $learningPath;

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
}
