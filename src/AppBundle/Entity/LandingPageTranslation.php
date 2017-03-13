<?php

namespace AppBundle\Entity;

use Application\Sonata\MediaBundle\Entity\Media;
use Doctrine\Common\Collections\ArrayCollection;

class LandingPageTranslation
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
     * @var LandingPage
     */
    private $landingPage;

    /**
     * @var string
     */
    protected $title;

    /**
     * @var string
     */
    protected $slug;

    /**
     * @var string
     */
    protected $intro;

    /**
     * @var string
     */
    protected $formTitle;

    /**
     * @var string
     */
    protected $submitButtonLabel;

    /**
     * @var string
     */
    protected $successMessage;

    /**
     * @var string
     */
    protected $emailSubject;

    /**
     * @var string
     */
    protected $emailContent;

    /**
     * @var Media
     */
    protected $picture;

    /**
     * @var string
     */
    protected $mailChimpListId;

    /**
     * @var LandingPageContact[]
     */
    protected $contacts;

    /**
     * @var Media
     */
    protected $document;

    public function __construct()
    {
        $this->contacts = new ArrayCollection();
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
    public function getLocale()
    {
        return $this->locale;
    }

    /**
     * @param string $locale
     */
    public function setLocale($locale)
    {
        $this->locale = $locale;
    }

    /**
     * @return LandingPage
     */
    public function getLandingPage()
    {
        return $this->landingPage;
    }

    /**
     * @param LandingPage $landingPage
     */
    public function setLandingPage($landingPage)
    {
        $this->landingPage = $landingPage;
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
     */
    public function setTitle($title)
    {
        $this->title = $title;
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

    /**
     * @return string
     */
    public function getIntro()
    {
        return $this->intro;
    }

    /**
     * @param string $intro
     */
    public function setIntro($intro)
    {
        $this->intro = $intro;
    }

    /**
     * @return string
     */
    public function getFormTitle()
    {
        return $this->formTitle;
    }

    /**
     * @param string $formTitle
     */
    public function setFormTitle($formTitle)
    {
        $this->formTitle = $formTitle;
    }

    /**
     * @return string
     */
    public function getSubmitButtonLabel()
    {
        return $this->submitButtonLabel;
    }

    /**
     * @param string $submitButtonLabel
     */
    public function setSubmitButtonLabel($submitButtonLabel)
    {
        $this->submitButtonLabel = $submitButtonLabel;
    }

    /**
     * @return string
     */
    public function getSuccessMessage()
    {
        return $this->successMessage;
    }

    /**
     * @param string $successMessage
     */
    public function setSuccessMessage($successMessage)
    {
        $this->successMessage = $successMessage;
    }

    /**
     * @return string
     */
    public function getEmailSubject()
    {
        return $this->emailSubject;
    }

    /**
     * @param string $emailSubject
     */
    public function setEmailSubject($emailSubject)
    {
        $this->emailSubject = $emailSubject;
    }

    /**
     * @return string
     */
    public function getEmailContent()
    {
        return $this->emailContent;
    }

    /**
     * @param string $emailContent
     */
    public function setEmailContent($emailContent)
    {
        $this->emailContent = $emailContent;
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

    /**
     * @return string
     */
    public function getMailChimpListId()
    {
        return $this->mailChimpListId;
    }

    /**
     * @param string $mailChimpListId
     */
    public function setMailChimpListId($mailChimpListId)
    {
        $this->mailChimpListId = $mailChimpListId;
    }

    /**
     * @return LandingPageContact[]
     */
    public function getContacts()
    {
        return $this->contacts;
    }

    /**
     * @param LandingPageContact[] $contacts
     */
    public function setContacts($contacts)
    {
        $this->contacts = $contacts;
    }

    /**
     * @return Media
     */
    public function getDocument()
    {
        return $this->document;
    }

    /**
     * @param Media $document
     */
    public function setDocument($document)
    {
        $this->document = $document;
    }

    public function __toString()
    {
        return $this->getTitle();
    }
}

