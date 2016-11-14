<?php

namespace AppBundle\Objects;

class EventSearch
{
    /**
     * @var string
     */
    protected $city;

    /**
     * @var string
     */
    protected $lang;

    /**
     * @var boolean
     */
    protected $free;

    public function getCity()
    {
        return $this->city;
    }

    public function setCity(string $city = null)
    {
        $this->city = $city;

        return $this;
    }

    public function getLang()
    {
        return $this->lang;
    }

    public function setLang(string $lang = null)
    {
        $this->lang = $lang;

        return $this;
    }

    public function isFree()
    {
        return $this->free;
    }

    public function setFree(bool $free)
    {
        $this->free = $free;

        return $this;
    }
}
