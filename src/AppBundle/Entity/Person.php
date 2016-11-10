<?php

namespace AppBundle\Entity;

use AppBundle\Interfaces\TranslatableInterface;
use Application\Sonata\MediaBundle\Entity\Media;
use Doctrine\Common\Collections\ArrayCollection;

class Person implements TranslatableInterface
{
    /**
     * @var int
     */
    private $id;

    /**
     * @var string
     */
    private $firstName;

    /**
     * @var string
     */
    private $lastName;

    /**
     * @var string
     */
    private $company;

    /**
     * @var boolean
     */
    private $quantumMonkeysMember;

    /**
     * @var Media
     */
    private $picture;

    /**
     * @var Media
     */
    private $pictureSquare;

    /**
     * @var PersonTranslation[]
     */
    private $translations;

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
     * Set firstName
     *
     * @param string $firstName
     *
     * @return Person
     */
    public function setFirstName($firstName)
    {
        $this->firstName = $firstName;

        return $this;
    }

    /**
     * Get firstName
     *
     * @return string
     */
    public function getFirstName()
    {
        return $this->firstName;
    }

    /**
     * Set lastName
     *
     * @param string $lastName
     *
     * @return Person
     */
    public function setLastName($lastName)
    {
        $this->lastName = $lastName;

        return $this;
    }

    /**
     * Get lastName
     *
     * @return string
     */
    public function getLastName()
    {
        return $this->lastName;
    }

    /**
     * Set company
     *
     * @param string $company
     *
     * @return Person
     */
    public function setCompany($company)
    {
        $this->company = $company;

        return $this;
    }

    /**
     * Get company
     *
     * @return string
     */
    public function getCompany()
    {
        return $this->company;
    }

    public function getDisplayName()
    {
        $displayName = $this->getFirstName();

        if ($this->getLastName()) {
            $displayName .= ' ' . $this->getLastName();
        }

        return $displayName;
    }

    /**
     * @return boolean
     */
    public function isQuantumMonkeysMember()
    {
        return $this->quantumMonkeysMember;
    }

    /**
     * @param boolean $quantumMonkeysMember
     */
    public function setQuantumMonkeysMember($quantumMonkeysMember)
    {
        $this->quantumMonkeysMember = $quantumMonkeysMember;
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
    public function setPicture(Media $picture)
    {
        $this->picture = $picture;
    }

    /**
     * @return Media
     */
    public function getPictureSquare()
    {
        return $this->pictureSquare;
    }

    /**
     * @param Media $pictureSquare
     */
    public function setPictureSquare(Media $pictureSquare)
    {
        $this->pictureSquare = $pictureSquare;
    }

    public function __toString()
    {
        return $this->getDisplayName();
    }

    public function addTranslation(PersonTranslation $personTranslation)
    {
        $personTranslation->setPerson($this);
        $this->translations[] = $personTranslation;

        return $this;
    }

    public function setTranslations($personTranslations)
    {
        $this->translations = $personTranslations;

        /** @var PersonTranslation $translation */
        foreach ($personTranslations as $translation) {
            $translation->setPerson($this);
        }
    }

    public function getTranslations()
    {
        return $this->translations;
    }
}

