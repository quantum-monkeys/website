<?php

namespace AppBundle\Controller;

use AppBundle\Entity\EventOccurrence;
use AppBundle\Entity\Trainings\LearningPath;
use AppBundle\Entity\Trainings\Workshop;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\ParamConverter;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Intl\Intl;

class AcademyController extends Controller
{
    public function indexAction(Request $request)
    {
        $this->get('app.manager.breadcrumb_generator')->generateAcademy();
        $learningPaths = $this->get('doctrine')->getRepository('AppBundle:Trainings\LearningPath')->findBy(
            [],
            [
                'position' => 'asc'
            ]
        );
        $workshops = $this->get('doctrine')->getRepository('AppBundle:Trainings\Workshop')->findBy(
            [],
            [
                'position' => 'asc'
            ]
        );

        return $this->render(
            'AppBundle:Academy:index.html.twig',
            [
                'learningPaths' => $learningPaths,
                'workshops' => $workshops,
            ]
        );
    }

    /**
     * @ParamConverter("workshop", class="AppBundle:Trainings\Workshop")
     */
    public function workshopAction(Workshop $workshop)
    {
        $this->get('app.manager.breadcrumb_generator')->generateWorkshop($workshop);

        return $this->render(
            'AppBundle:Academy:workshop.html.twig',
            [
                'training' => $workshop,
            ]
        );
    }

    /**
     * @ParamConverter("learningPath", class="AppBundle:Trainings\LearningPath")
     */
    public function learningPathAction(LearningPath $learningPath)
    {
        $this->get('app.manager.breadcrumb_generator')->generateLearningPath($learningPath);

        return $this->render(
            'AppBundle:Academy:learningPath.html.twig',
            [
                'training' => $learningPath,
            ]
        );
    }
}
