<?php

namespace AppBundle\Entity;

class LandingPageContact
{
    /**
     * @var int
     */
    private $id;

    /**
     * @var LandingPageTranslation
     */
    private $landingPageTranslation;

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
     * @var string
     */
    private $email;

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
     * @return LandingPageTranslation
     */
    public function getLandingPageTranslation()
    {
        return $this->landingPageTranslation;
    }

    /**
     * @param LandingPageTranslation $landingPageTranslation
     *
     * @return LandingPageContact
     */
    public function setLandingPageTranslation(LandingPageTranslation $landingPageTranslation)
    {
        $this->landingPageTranslation = $landingPageTranslation;

        return $this;
    }

    /**
     * Set firstName
     *
     * @param string $firstName
     *
     * @return LandingPageContact
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
     * @return LandingPageContact
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
     * @return LandingPageContact
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
     * @return string
     */
    public function getEmail()
    {
        return $this->email;
    }

    /**
     * @param string $email
     *
     * @return LandingPageContact
     */
    public function setEmail(string $email)
    {
        $this->email = $email;

        return $this;
    }
}

