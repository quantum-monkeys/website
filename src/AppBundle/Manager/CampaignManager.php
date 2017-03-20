<?php

namespace AppBundle\Manager;

use AppBundle\Entity\Marketing\Contact;
use Doctrine\ORM\EntityManager;

class CampaignManager
{
    protected $em;
    protected $emailManager;
    protected $mailChimpListManager;

    public function __construct(EntityManager $em, EmailManager $emailManager, MailchimpListManager $mailChimpListManager)
    {
        $this->em = $em;
        $this->emailManager = $emailManager;
        $this->mailChimpListManager = $mailChimpListManager;
    }

    public function processContact(Contact $contact)
    {
        $this->saveContact($contact);
        $this->subscribeContactToMailChimp($contact);
        $this->sendEmail($contact);
    }

    public function saveContact(Contact $contact)
    {
        $this->em->persist($contact);
        $this->em->flush();
    }

    protected function subscribeContactToMailChimp(Contact $contact) {
        $returnCode = $this->mailChimpListManager->subscribe(
            $contact->getEmail(),
            $contact->getFirstName(),
            $contact->getLastName(),
            $contact->getCampaignTranslation()->getMailChimpListId()
        );

        if ($returnCode === MailchimpListManager::UNKNOWN_ERROR) {
            $this->emailManager->sendDebugEmail([
                'message' => 'Enregistrement à Mailchimp qui fail pour '
                    . $contact->getFirstName() . ' ' . $contact->getLastName()
                    . ' (' . $contact->getEmail() . ') pour la liste '
                    . $contact->getCampaignTranslation()->getTitle(),
            ]);
        }
    }

    protected function sendEmail(Contact $contact)
    {
        $this->emailManager->sendCampaignFirstEmail($contact);
    }
}
