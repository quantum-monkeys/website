<?php

namespace AppBundle\Entity;

use Application\Sonata\MediaBundle\Entity\Media;

/**
 * Event
 */
abstract class Event
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
    private $description;

    /**
     * @var string
     */
    private $lang;

//    /**
//     * @var Media
//     */
//    private $picture;

    public function getId() : int
    {
        return $this->id;
    }

    public function setName(string $name) : Event
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
     * @return Event
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

    /**
     * Set lang
     *
     * @param string $lang
     *
     * @return Event
     */
    public function setLang($lang)
    {
        $this->lang = $lang;

        return $this;
    }

    /**
     * Get lang
     *
     * @return string
     */
    public function getLang()
    {
        return $this->lang;
    }
//
//    /**
//     * @return Media
//     */
//    public function getPicture()
//    {
//        return $this->picture;
//    }
//
//    /**
//     * @param Media $picture
//     */
//    public function setPicture(Media $picture)
//    {
//        $this->picture = $picture;
//    }
}

