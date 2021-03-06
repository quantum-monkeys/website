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
     * @var int
     */
    private $position;

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
     * @var PersonTranslation[]
     */
    private $translations;

    /**
     * @var Certification[]
     */
    private $certifications;

    /**
     * @var string
     */
    protected $slug;

    /**
     * @var string
     */
    protected $linkedInProfile;

    public function __construct()
    {
        $this->translations = new ArrayCollection();
        $this->certifications = new ArrayCollection();
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
     * @return int
     */
    public function getPosition()
    {
        return $this->position;
    }

    /**
     * @param int $position
     */
    public function setPosition($position)
    {
        $this->position = $position;
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

    /**
     * @return Certification[]
     */
    public function getCertifications()
    {
        return $this->certifications;
    }

    /**
     * @param Certification[] $certifications
     */
    public function setCertifications($certifications)
    {
        $this->certifications = $certifications;
    }

    /**
     * @return string
     */
    public function getLinkedInProfile()
    {
        return $this->linkedInProfile;
    }

    /**
     * @param string $linkedInProfile
     */
    public function setLinkedInProfile($linkedInProfile)
    {
        $this->linkedInProfile = $linkedInProfile;
    }

    /**
     * @return string
     */
    public function getSlug()
    {
        return $this->slug;
    }

    /**
     * @param string $slug
     */
    public function setSlug($slug)
    {
        $this->slug = $slug;
    }

    public function __toString()
    {
        return $this->getDisplayName();
    }
}

