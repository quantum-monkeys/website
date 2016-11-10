<?php

namespace AppBundle\Entity;

class EventOccurrenceTranslation
{
    /**
     * @var int
     */
    private $id;

    /**
     * @var string
     */
    private $locale;

    /**
     * @var EventOccurrence
     */
    private $eventOccurrence;

    /**
     * @var string
     */
    private $name;

    /**
     * @var string
     */
    private $description;

    public function getId() : int
    {
        return $this->id;
    }

    /**
     * @return string
     */
    public function getLocale()
    {
        return $this->locale;
    }

    /**
     * @param string $locale
     */
    public function setLocale(string $locale)
    {
        $this->locale = $locale;
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

    public function setName(string $name) : EventOccurrenceTranslation
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
     * Set description
     *
     * @param string $description
     *
     * @return EventOccurrenceTranslation
     */
    public function setDescription($description)
    {
        $this->description = $description;

        return $this;
    }

    /**
     * Get description
     *
     * @return string
     */
    public function getDescription()
    {
        return $this->description;
    }
}

