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
    protected $content;

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

    public function getContent()
    {
        return $this->content;
    }

    public function setContent(string $content = null)
    {
        $this->content = $content;

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

    public function isFree(): bool
    {
        return $this->free;
    }

    public function setFree(bool $free)
    {
        $this->free = $free;

        return $this;
    }
}
