<?php

namespace AppBundle\Entity\Marketing;

use Application\Sonata\MediaBundle\Entity\Media;
use Doctrine\Common\Collections\ArrayCollection;

class CampaignTranslation
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
     * @var Campaign
     */
    private $campaign;

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
    protected $mainContent;

    /**
     * @var string
     */
    protected $mainFormTitle;

    /**
     * @var string
     */
    protected $mainSubmitButtonLabel;

    /**
     * @var string
     */
    protected $mainSuccessMessage;

    /**
     * @var string
     */
    protected $contactContent;

    /**
     * @var string
     */
    protected $contactFormTitle;

    /**
     * @var string
     */
    protected $contactSubmitButtonLabel;

    /**
     * @var string
     */
    protected $contactSuccessMessage;

    /**
     * @var string
     */
    protected $firstEmailSubject;

    /**
     * @var string
     */
    protected $firstEmailContent;

    /**
     * @var Media
     */
    protected $mainPicture;

    /**
     * @var string
     */
    protected $mailChimpListId;

    /**
     * @var Contact[]
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
     * @return Campaign
     */
    public function getCampaign()
    {
        return $this->campaign;
    }

    /**
     * @param Campaign $campaign
     *
     * @return CampaignTranslation
     */
    public function setCampaign($campaign)
    {
        $this->campaign = $campaign;

        return $this;
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
     * @return CampaignTranslation
     */
    public function setTitle($title)
    {
        $this->title = $title;

        return $this;
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
     *
     * @return CampaignTranslation
     */
    public function setSlug($slug)
    {
        $this->slug = $slug;

        return $this;
    }

    /**
     * @return string
     */
    public function getMainContent()
    {
        return $this->mainContent;
    }

    /**
     * @param string $content
     *
     * @return CampaignTranslation
     */
    public function setMainContent($content)
    {
        $this->mainContent = $content;

        return $this;
    }

    /**
     * @return string
     */
    public function getMainFormTitle()
    {
        return $this->mainFormTitle;
    }

    /**
     * @param string $formTitle
     *
     * @return CampaignTranslation
     */
    public function setMainFormTitle($formTitle)
    {
        $this->mainFormTitle = $formTitle;

        return $this;
    }

    /**
     * @return string
     */
    public function getMainSubmitButtonLabel()
    {
        return $this->mainSubmitButtonLabel;
    }

    /**
     * @param string $submitButtonLabel
     *
     * @return CampaignTranslation
     */
    public function setMainSubmitButtonLabel($submitButtonLabel)
    {
        $this->mainSubmitButtonLabel = $submitButtonLabel;

        return $this;
    }

    /**
     * @return string
     */
    public function getMainSuccessMessage()
    {
        return $this->mainSuccessMessage;
    }

    /**
     * @param string $successMessage
     *
     * @return CampaignTranslation
     */
    public function setMainSuccessMessage($successMessage)
    {
        $this->mainSuccessMessage = $successMessage;

        return $this;
    }

    /**
     * @return string
     */
    public function getContactContent()
    {
        return $this->contactContent;
    }

    /**
     * @param string $contactContent
     *
     * @return CampaignTranslation
     */
    public function setContactContent($contactContent)
    {
        $this->contactContent = $contactContent;

        return $this;
    }

    /**
     * @return string
     */
    public function getContactFormTitle()
    {
        return $this->contactFormTitle;
    }

    /**
     * @param string $contactFormTitle
     *
     * @return CampaignTranslation
     */
    public function setContactFormTitle($contactFormTitle)
    {
        $this->contactFormTitle = $contactFormTitle;

        return $this;
    }

    /**
     * @return string
     */
    public function getContactSubmitButtonLabel()
    {
        return $this->contactSubmitButtonLabel;
    }

    /**
     * @param string $contactSubmitButtonLabel
     *
     * @return CampaignTranslation
     */
    public function setContactSubmitButtonLabel($contactSubmitButtonLabel)
    {
        $this->contactSubmitButtonLabel = $contactSubmitButtonLabel;

        return $this;
    }

    /**
     * @return string
     */
    public function getContactSuccessMessage()
    {
        return $this->contactSuccessMessage;
    }

    /**
     * @param string $contactSuccessMessage
     *
     * @return CampaignTranslation
     */
    public function setContactSuccessMessage($contactSuccessMessage)
    {
        $this->contactSuccessMessage = $contactSuccessMessage;

        return $this;
    }

    /**
     * @return string
     */
    public function getFirstEmailSubject()
    {
        return $this->firstEmailSubject;
    }

    /**
     * @param string $emailSubject
     *
     * @return CampaignTranslation
     */
    public function setFirstEmailSubject($emailSubject)
    {
        $this->firstEmailSubject = $emailSubject;

        return $this;
    }

    /**
     * @return string
     */
    public function getFirstEmailContent()
    {
        return $this->firstEmailContent;
    }

    /**
     * @param string $emailContent
     *
     * @return CampaignTranslation
     */
    public function setFirstEmailContent($emailContent)
    {
        $this->firstEmailContent = $emailContent;

        return $this;
    }

    /**
     * @return Media
     */
    public function getMainPicture()
    {
        return $this->mainPicture;
    }

    /**
     * @param Media $picture
     *
     * @return CampaignTranslation
     */
    public function setMainPicture($picture)
    {
        $this->mainPicture = $picture;

        return $this;
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
     *
     * @return CampaignTranslation
     */
    public function setMailChimpListId($mailChimpListId)
    {
        $this->mailChimpListId = $mailChimpListId;

        return $this;
    }

    /**
     * @return Contact[]
     */
    public function getContacts()
    {
        return $this->contacts;
    }

    /**
     * @param Contact[] $contacts
     *
     * @return CampaignTranslation
     */
    public function setContacts($contacts)
    {
        $this->contacts = $contacts;

        return $this;
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
     *
     * @return CampaignTranslation
     */
    public function setDocument($document)
    {
        $this->document = $document;

        return $this;
    }

    public function __toString()
    {
        return $this->getTitle();
    }
}

