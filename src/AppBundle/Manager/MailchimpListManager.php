<?php

namespace AppBundle\Manager;

use GuzzleHttp\Client;
use GuzzleHttp\Exception\BadResponseException;
use Symfony\Component\HttpFoundation\RequestStack;
use Symfony\Component\Translation\TranslatorInterface;

class MailchimpListManager extends MailchimpManager
{
    const ALREADY_SUBSCRIBED = 'already_subscribed';

    /**
     * @var TranslatorInterface
     */
    protected $translator;

    /**
     * @var string
     */
    protected $listId;

    public function __construct(RequestStack $requestStack, Client $mailChimpClient, TranslatorInterface $translator, string $listId = null)
    {
        parent::__construct($requestStack, $mailChimpClient);

        $this->translator = $translator;
        $this->listId = $listId;
    }

    public function create(string $listName, string $locale)
    {
        try {
            $response = $this->mailChimpClient->post(
                '/3.0/lists',
                [
                    'json' => [
                        'name' => $listName,
                        'contact' => [
                            'company' => 'Quantum Monkeys',
                            'address1' => $this->translator->trans('mailchimp.address', [], 'landingpage', $locale),
                            'city' => $this->translator->trans('mailchimp.city', [], 'landingpage', $locale),
                            'state' => 'QC',
                            'zip' => 'H3J2T8',
                            'country' => 'CA',
                        ],
                        'permission_reminder' => $this->translator->trans('mailchimp.permission_reminder', [ '%list_name%' => $listName ], 'landingpage', $locale),
                        'campaign_defaults' => [
                            'from_name' => 'Quantum Monkeys',
                            'from_email' => 'company@quantummonkeys.com',
                            'subject' => '',
                            'language' => $locale,
                        ],
                        'email_type_option' => false,
                    ],
                ]
            );

            $body = json_decode($response->getBody(), true);

            return $body['id'];
        } catch (BadResponseException $e) {
            return null;
        }
    }

    public function subscribe(string $email, string $firstName = null, string $lastName = null, string $listId = null)
    {
        try {
            $listId = $listId === null ? $this->listId : $listId;

            $this->mailChimpClient->post(
                sprintf('/3.0/lists/%s/members', $listId),
                [
                    'json' => [
                        'email_address' => $email,
                        'status' => 'subscribed',
                        'merge_fields' => [
                            'FNAME' => $firstName,
                            'LNAME' => $lastName,
                        ],
                        'language' => $this->getLocale(),
                    ],
                ]
            );

            return self::SUCCESS;
        } catch (BadResponseException $e) {
            $body = json_decode($e->getResponse()->getBody(), true);

            if ($body['title'] === 'Member Exists') {
                return self::ALREADY_SUBSCRIBED;
            }

            return self::UNKNOWN_ERROR;
        }
    }
}
