<?php

namespace AppBundle\Entity;

/**
 * EventOccurrenceCost
 */
class EventOccurrenceCost
{
    /**
     * @var int
     */
    private $id;

    /**
     * @var string
     */
    private $name;

    /**
     * @var string
     */
    private $cost;

    /**
     * @var string
     */
    private $currency;

    /**
     * @var EventOccurrence
     */
    private $eventOccurrence;


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
     * Set name
     *
     * @param string $name
     *
     * @return EventOccurrenceCost
     */
    public function setName($name)
    {
        $this->name = $name;

        return $this;
    }

    /**
     * Get name
     *
     * @return string
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * Set cost
     *
     * @param string $cost
     *
     * @return EventOccurrenceCost
     */
    public function setCost($cost)
    {
        $this->cost = $cost;

        return $this;
    }

    /**
     * Get cost
     *
     * @return string
     */
    public function getCost()
    {
        return $this->cost;
    }

    /**
     * Set currency
     *
     * @param string $currency
     *
     * @return EventOccurrenceCost
     */
    public function setCurrency($currency)
    {
        $this->currency = $currency;

        return $this;
    }

    /**
     * Get currency
     *
     * @return string
     */
    public function getCurrency()
    {
        return $this->currency;
    }

    /**
     * @return EventOccurrence
     */
    public function getEventOccurrence()
    {
        return $this->eventOccurrence;
    }

    /**
     * @param EventOccurrence $eventOccurrence
     */
    public function setEventOccurrence(EventOccurrence $eventOccurrence)
    {
        $this->eventOccurrence = $eventOccurrence;
    }
}

