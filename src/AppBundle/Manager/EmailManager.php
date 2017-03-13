<?php

namespace AppBundle\Manager;

use Symfony\Bridge\Twig\TwigEngine;

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
     * @var string
     */
    protected $generalEmailAddress;
    /**
     * @var string
     */
    protected $adminEmailAddress;

    public function __construct(\Swift_Mailer $mailer, TwigEngine $twigEngine,
                                string $generalEmailAddress, string $adminEmailAddress)
    {
        $this->mailer = $mailer;
        $this->twigEngine = $twigEngine;
        $this->generalEmailAddress = $generalEmailAddress;
        $this->adminEmailAddress = $adminEmailAddress;
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

    protected function createGenericMessage()
    {
        return \Swift_Message::newInstance()
            ->setFrom($this->generalEmailAddress);
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
