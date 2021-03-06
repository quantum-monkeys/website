<?php

namespace AppBundle\Manager;

use AppBundle\Entity\Marketing\Contact;
use Symfony\Bridge\Twig\TwigEngine;
use Symfony\Component\HttpFoundation\RequestStack;
use Symfony\Component\Translation\TranslatorInterface;

class EmailManager
{
    /**
     * @var \Swift_Mailer
     */
    protected $mailer;
    /**
     * @var TwigEngine
     */
    protected $twigEngine;
    /**
     * @var RequestStack
     */
    protected $requestStack;
    /**
     * @var string
     */
    protected $generalEmailAddress;
    /**
     * @var string
     */
    protected $adminEmailAddress;
    /**
     * @var TranslatorInterface
     */
    protected $translator;

    public function __construct(\Swift_Mailer $mailer, TwigEngine $twigEngine, RequestStack $requestStack,
                                string $generalEmailAddress, string $adminEmailAddress, TranslatorInterface $translator)
    {
        $this->mailer = $mailer;
        $this->twigEngine = $twigEngine;
        $this->requestStack = $requestStack;
        $this->generalEmailAddress = $generalEmailAddress;
        $this->adminEmailAddress = $adminEmailAddress;
        $this->translator = $translator;
    }

    public function sendDebugEmail(array $debugData)
    {
        $message = $this->createAdminMessage()
            ->setSubject('Une erreur est survenue');

        $this->render(
            $message,
            'AppBundle:Emails:admin.html.twig',
            'AppBundle:Emails:admin.txt.twig',
            [ 'data' => $debugData ]
        );

        return $this->send($message);
    }

    public function sendContactEmail(array $contactData)
    {
        $message = $this->createToCompanyMessage()
            ->setSubject('Message from: ' . $contactData['firstName'] . ' ' . $contactData['lastName']);

        $this->render(
            $message,
            'AppBundle:Emails:contact.html.twig',
            'AppBundle:Emails:contact.txt.twig',
            [ 'data' => $contactData ]
        );

        return $this->send($message);
    }

    public function sendCultureFestEmail(string $email)
    {
        $message = $this->createToSomeoneMessage($email)
            ->setSubject($this->translator->trans('email.subject', [], 'ouibounce'));

        $this->render(
            $message,
            'AppBundle:Emails:culture_fest_thanks.html.twig',
            'AppBundle:Emails:culture_fest_thanks.txt.twig',
            []
        );

        $hostMessageSent = $this->send($message);

        $message = $this->createToCompanyMessage()
            ->setSubject('Culture Fest Promotion: Invitation');

        $this->render(
            $message,
            'AppBundle:Emails:culture_fest.html.twig',
            'AppBundle:Emails:culture_fest.txt.twig',
            [ 'email' => $email ]
        );

        $companyMessageSent = $this->send($message);

        return $hostMessageSent && $companyMessageSent;
    }

    public function sendCampaignFirstEmail(Contact $contact)
    {
        $message = $this->createToSomeoneMessage($contact->getEmail())
            ->setSubject($contact->getCampaignTranslation()->getFirstEmailSubject());

        $this->render(
            $message,
            'AppBundle:Emails:campaign_first.html.twig',
            'AppBundle:Emails:campaign_first.txt.twig',
            [ 'contact' => $contact ]
        );

        return $this->send($message);
    }

    protected function send($message)
    {
        try {
            $recipients = $this->mailer->send($message);

            if ($recipients > 0) {
                return true;
            }
        } catch(\Exception $e) {
        }

        return false;
    }

    protected function createAdminMessage()
    {
        return $this->createGenericMessage()
            ->setTo($this->adminEmailAddress);
    }

    protected function createToCompanyMessage()
    {
        return $this->createGenericMessage()
            ->setTo($this->generalEmailAddress);
    }

    protected function createToSomeoneMessage(string $emailAddress)
    {
        return $this->createGenericMessage()
            ->setTo($emailAddress);
    }

    protected function createGenericMessage()
    {
        $locale = $this->requestStack->getMasterRequest()->getLocale();
        $teamName = 'The Quantum Monkeys Team';

        if ($locale === 'fr') {
            $teamName = 'L\'équipe Quantum Monkeys';
        }

        return \Swift_Message::newInstance()
            ->setFrom($this->generalEmailAddress, $teamName);
    }

    protected function render(&$message, string $htmlTemplateName, string $txtTemplateName, array $parameters)
    {
        /** @var \Swift_Message $message */
        $message
            ->setBody(
                $this->twigEngine->render(
                    $htmlTemplateName,
                    $parameters
                ),
                'text/html'
            )
            ->addPart(
                $this->twigEngine->render(
                    $txtTemplateName,
                    $parameters
                ),
                'text/plain'
            )
        ;
    }
}
