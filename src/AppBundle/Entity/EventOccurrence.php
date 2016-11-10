<?php

namespace AppBundle\Entity;

use AppBundle\Interfaces\TranslatableInterface;
use Doctrine\Common\Collections\ArrayCollection;
use Application\Sonata\MediaBundle\Entity\Media;

/**
 * EventOccurrence
 */
class EventOccurrence implements TranslatableInterface
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
     * @var Person[]
     */
    private $speakers;

    /**
     * @var EventOccurrenceCost[]
     */
    private $costs;

    /**
     * @var string[]
     */
    private $languages;

    /**
     * @var Media
     */
    private $picture;

    /**
     * @var EventOccurrenceTranslation[]
     */
    private $translations;

    public function __construct()
    {
        $this->costs = new ArrayCollection();
        $this->speakers = new ArrayCollection();
        $this->languages = [];
        $this->translations = [];//new ArrayCollection();
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

    /**
     * @return Person[]
     */
    public function getSpeakers()
    {
        return $this->speakers;
    }

    /**
     * @param Person[] $speakers
     */
    public function setSpeakers($speakers)
    {
        $this->speakers = $speakers;
    }

    /**
     * @return string[]
     */
    public function getLanguages()
    {
        return $this->languages;
    }

    /**
     * @param string[] $languages
     */
    public function setLanguages($languages)
    {
        $this->languages = $languages;
    }

    /**
     * @return Media
     */
    public function getPicture()
    {
        return $this->picture;
    }

    /**
     * @param Media $picture
     */
    public function setPicture($picture)
    {
        $this->picture = $picture;
    }

    public function addTranslation(EventOccurrenceTranslation $eventOccurrenceTranslation)
    {
        $eventOccurrenceTranslation->setEventOccurrence($this);
        $this->translations[] = $eventOccurrenceTranslation;

        return $this;
    }

    public function setTranslations($eventOccurrenceTranslations)
    {
        $this->translations = $eventOccurrenceTranslations;

        /** @var EventOccurrenceTranslation $translation */
        foreach ($eventOccurrenceTranslations as $translation) {
            $translation->setEventOccurrence($this);
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

