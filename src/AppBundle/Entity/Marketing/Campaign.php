<?php

namespace AppBundle\Entity\Marketing;

use AppBundle\Entity\Person;
use AppBundle\Interfaces\TranslatableInterface;
use Doctrine\Common\Collections\ArrayCollection;

class Campaign implements TranslatableInterface
{
    /**
     * @var int
     */
    protected $id;

    /**
     * @var string
     */
    protected $title;

    /**
     * @var Person
     */
    protected $author;

    /**
     * @var CampaignTranslation[]
     */
    protected $translations;

    public function __construct()
    {
        $this->translations = new ArrayCollection();
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
     * @return string
     */
    public function getTitle()
    {
        return $this->title;
    }

    /**
     * @param string $title
     *
     * @return Campaign
     */
    public function setTitle($title)
    {
        $this->title = $title;

        return $this;
    }

    /**
     * @return Person
     */
    public function getAuthor()
    {
        return $this->author;
    }

    /**
     * @param Person $author
     *
     * @return Campaign
     */
    public function setAuthor($author)
    {
        $this->author = $author;

        return $this;
    }

    public function addTranslation(CampaignTranslation $campaignTranslation)
    {
        $campaignTranslation->setCampaign($this);
        $this->translations[] = $campaignTranslation;

        return $this;
    }

    public function setTranslations($campaignTranslations)
    {
        $this->translations = $campaignTranslations;

        /** @var CampaignTranslation $translation */
        foreach ($campaignTranslations as $translation) {
            $translation->setCampaign($this);
        }
    }

    public function getTranslations()
    {
        return $this->translations;
    }

    public function __toString()
    {
        return $this->getTitle();
    }
}

