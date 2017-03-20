<?php

namespace AppBundle\Command;

use AppBundle\Entity\LandingPageContact;
use AppBundle\Manager\EmailManager;
use Doctrine\ORM\EntityManager;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;

class TestEmailCommand extends Command
{
    protected $emailManager;
    protected $em;

    public function __construct(EntityManager $entityManager, EmailManager $emailManager)
    {
        parent::__construct('app:test-email');

        $this->emailManager = $emailManager;
        $this->em = $entityManager;
    }

    protected function configure()
    {
        $this
            ->setName('app:test-email')
            ->setDescription('Test an email')
            ->addArgument('type', InputArgument::REQUIRED, 'The type of the email');
    }

    protected function execute(InputInterface $input, OutputInterface $output)
    {
        $emailType = $input->getArgument('type');

        $output->writeln([
            'Send email',
            '============',
            'type: ' . $emailType,
            ''
        ]);

        switch ($emailType) {
            case 'landing_page_first':
                $this->sendLandingPageFirst($output);
                break;
            default:
                $output->writeln('Nothing to send');
        }
    }

    protected function sendLandingPageFirst(OutputInterface $output) {
        $output->writeln('Send the landing page first email');

        $landingPageTranslation = $this->em->getRepository('AppBundle:LandingPageTranslation')->findOneBy([]);

        $contact = new LandingPageContact();
        $contact->setLandingPageTranslation($landingPageTranslation)
            ->setEmail('axel@quantummonkeys.com')
            ->setFirstName('Axel')
            ->setLastName('Moussard');

        $this->emailManager->sendLandingPageFirstEmail($contact);
    }
}
