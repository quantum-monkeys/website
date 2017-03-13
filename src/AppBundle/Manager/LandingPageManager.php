<?php

namespace AppBundle\Manager;

use AppBundle\Entity\LandingPageContact;
use Doctrine\ORM\EntityManager;

class LandingPageManager
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

    public function processContact(LandingPageContact $contact)
    {
        $this->saveContact($contact);
        $this->subscribeContactToMailChimp($contact);
        $this->sendEmail($contact);
    }

    protected function saveContact(LandingPageContact $contact)
    {
        $this->em->persist($contact);
        $this->em->flush();
    }

    protected function subscribeContactToMailChimp(LandingPageContact $contact) {
        $returnCode = $this->mailChimpListManager->subscribe(
            $contact->getEmail(),
            $contact->getFirstName(),
            $contact->getLastName(),
            $contact->getLandingPageTranslation()->getMailChimpListId()
        );

        if ($returnCode === MailchimpListManager::UNKNOWN_ERROR) {
            $this->emailManager->sendDebugEmail([
                'message' => 'Enregistrement à Mailchimp qui fail pour '
                    . $contact->getFirstName() . ' ' . $contact->getLastName()
                    . ' (' . $contact->getEmail() . ') pour la liste '
                    . $contact->getLandingPageTranslation()->getTitle(),
            ]);
        }
    }

    protected function sendEmail(LandingPageContact $contact)
    {
        $this->emailManager->sendLandingPageFirstEmail($contact);
    }
}
