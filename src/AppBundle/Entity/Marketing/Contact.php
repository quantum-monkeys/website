<?php

namespace AppBundle\Entity\Marketing;

class Contact
{
    /**
     * @var int
     */
    protected $id;

    /**
     * @var CampaignTranslation
     */
    protected $campaignTranslation;

    /**
     * @var string
     */
    protected $firstName;

    /**
     * @var string
     */
    protected $lastName;

    /**
     * @var Company
     */
    protected $company;

    /**
     * @var string
     */
    protected $email;

    /**
     * @var string
     */
    protected $jobTitle;

    /**
     * @var string
     */
    protected $contactReason;

    /**
     * @var string
     */
    protected $message;

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
     * @return CampaignTranslation
     */
    public function getCampaignTranslation()
    {
        return $this->campaignTranslation;
    }

    /**
     * @param CampaignTranslation $campaignTranslation
     *
     * @return Contact
     */
    public function setCampaignTranslation(CampaignTranslation $campaignTranslation)
    {
        $this->campaignTranslation = $campaignTranslation;

        return $this;
    }

    /**
     * Set firstName
     *
     * @param string $firstName
     *
     * @return Contact
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
     * @return Contact
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
     * @param Company $company
     *
     * @return Contact
     */
    public function setCompany($company)
    {
        $this->company = $company;

        return $this;
    }

    /**
     * Get company
     *
     * @return Company
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
     * @return Contact
     */
    public function setEmail(string $email)
    {
        $this->email = $email;

        return $this;
    }

    /**
     * @return string
     */
    public function getJobTitle()
    {
        return $this->jobTitle;
    }

    /**
     * @param string $jobTitle
     *
     * @return Contact
     */
    public function setJobTitle($jobTitle)
    {
        $this->jobTitle = $jobTitle;

        return $this;
    }

    /**
     * @return string
     */
    public function getContactReason()
    {
        return $this->contactReason;
    }

    /**
     * @param string $contactReason
     *
     * @return Contact
     */
    public function setContactReason($contactReason)
    {
        $this->contactReason = $contactReason;

        return $this;
    }

    /**
     * @return string
     */
    public function getMessage()
    {
        return $this->message;
    }

    /**
     * @param string $message
     *
     * @return Contact
     */
    public function setMessage($message)
    {
        $this->message = $message;

        return $this;
    }

    public function __toString()
    {
        return $this->getDisplayName();
    }
}

