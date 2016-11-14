<?php

namespace AppBundle\Controller;

use AppBundle\Entity\EventOccurrence;
use AppBundle\Form\Type\EventSearchType;
use AppBundle\Objects\EventSearch;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\ParamConverter;
use Symfony\Component\HttpFoundation\Request;

class EventController extends Controller
{
    public function indexAction(Request $request)
    {
        $this->get('app.manager.breadcrumb_generator')->generateEvents();

        $searchEngine = $this->get('app.manager.search_engine');
        $eventSearch = $searchEngine->getEventSearch($request);
        $events = $searchEngine->getResults($eventSearch);
        $form = $this->createForm(EventSearchType::class, $eventSearch, [
            'method' => 'GET',
        ]);

        return $this->render(
            'AppBundle:Event:index.html.twig',
            [
                'events' => $events,
                'form' => $form->createView(),
            ]
        );
    }

    /**
     * @ParamConverter("eventOccurrence", class="AppBundle:EventOccurrence")
     */
    public function showAction(EventOccurrence $eventOccurrence)
    {
        $this->get('app.manager.breadcrumb_generator')->generateEvent($eventOccurrence);

        $gMapSearch = '';
        $gMapSearch .= $eventOccurrence->getLocation()->getStreetNumber() . ' ' . $eventOccurrence->getLocation()->getStreetName();
        $gMapSearch .= ', ' . $eventOccurrence->getLocation()->getCity();
        $gMapSearch .= ', ' . $eventOccurrence->getLocation()->getRegion();
        $gMapSearch .= ' ' . $eventOccurrence->getLocation()->getZipCode();
        $gMapSearch .= ', ' . $eventOccurrence->getLocation()->getCountry();

        return $this->render(
            'AppBundle:Event:show.html.twig',
            [
                'eventOccurrence' => $eventOccurrence,
                'gmapQuery' => urlencode($gMapSearch),
            ]
        );
    }

    public function widgetAction()
    {
        $searchEngine = $this->get('app.manager.search_engine');
        $eventSearch = new EventSearch();
        $events = $searchEngine->getResults($eventSearch, 4);

        return $this->render(
            'AppBundle:Event:widget.html.twig',
            [
                'events' => $events
            ]
        );
    }
}
