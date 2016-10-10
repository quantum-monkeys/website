<?php

namespace AppBundle\Entity;

/**
 * EventOccurrence
 */
class EventOccurrence
{
    /**
     * @var int
     */
    private $id;

    /**
     * @var \DateTime
     */
    private $begin;

    /**
     * @var \DateTime
     */
    private $end;

    /**
     * @var int
     */
    private $remainingSeats;

    /**
     * @var string
     */
    private $eventBriteLink;

    /**
     * @var Location
     */
    private $location;

    /**
     * @var Event
     */
    private $event;

    /**
     * @var boolean
     */
    private $free;

    /**
     * @var EventOccurrenceCost[]
     */
    private $costs;

    public function __construct()
    {
        $this->costs = [];
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
     * Set begin
     *
     * @param \DateTime $begin
     *
     * @return EventOccurrence
     */
    public function setBegin($begin)
    {
        $this->begin = $begin;

        return $this;
    }

    /**
     * Get begin
     *
     * @return \DateTime
     */
    public function getBegin()
    {
        return $this->begin;
    }

    /**
     * Set end
     *
     * @param \DateTime $end
     *
     * @return EventOccurrence
     */
    public function setEnd($end)
    {
        $this->end = $end;

        return $this;
    }

    /**
     * Get end
     *
     * @return \DateTime
     */
    public function getEnd()
    {
        return $this->end;
    }

    /**
     * Set remainingSeats
     *
     * @param integer $remainingSeats
     *
     * @return EventOccurrence
     */
    public function setRemainingSeats($remainingSeats)
    {
        $this->remainingSeats = $remainingSeats;

        return $this;
    }

    /**
     * Get remainingSeats
     *
     * @return int
     */
    public function getRemainingSeats()
    {
        return $this->remainingSeats;
    }

    /**
     * Set eventBriteLink
     *
     * @param string $eventBriteLink
     *
     * @return EventOccurrence
     */
    public function setEventBriteLink($eventBriteLink)
    {
        $this->eventBriteLink = $eventBriteLink;

        return $this;
    }

    /**
     * Get eventBriteLink
     *
     * @return string
     */
    public function getEventBriteLink()
    {
        return $this->eventBriteLink;
    }

    /**
     * @return Location
     */
    public function getLocation()
    {
        return $this->location;
    }

    /**
     * @param Location $location
     */
    public function setLocation(Location $location)
    {
        $this->location = $location;
    }

    /**
     * @return Event
     */
    public function getEvent()
    {
        return $this->event;
    }

    /**
     * @param Event $event
     */
    public function setEvent(Event $event)
    {
        $this->event = $event;
    }

    /**
     * @return EventOccurrenceCost[]
     */
    public function getCosts()
    {
        return $this->costs;
    }

    /**
     * @param EventOccurrenceCost[] $costs
     */
    public function setCosts($costs)
    {
        $this->costs = $costs;
    }

    public function addCost(EventOccurrenceCost $cost)
    {
        $this->costs[] = $cost;

        return $this->costs;
    }

    /**
     * @return boolean
     */
    public function isFree()
    {
        return $this->free;
    }

    /**
     * @param boolean $free
     */
    public function setFree(bool $free)
    {
        $this->free = $free;
    }
}

