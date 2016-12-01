<?php

namespace AppBundle\Manager;

use GuzzleHttp\Client;
use GuzzleHttp\Exception\BadResponseException;
use Symfony\Component\HttpFoundation\RequestStack;
use ZfrMailChimp\Client\MailChimpClient;
use ZfrMailChimp\Exception\Ls\AlreadySubscribedException;
use ZfrMailChimpBundle\Services\MailChimpHandler;

class NewsletterManager
{
    const SUCCESS = 'success';
    const ALREADY_SUBSCRIBED = 'already_subscribed';
    const UNKNOWN_ERROR = 'unknown_error';

    /**
     * @var RequestStack
     */
    protected $requestStack;

    /**
     * @var Client
     */
    protected $mailChimpClient;

    /**
     * @var string
     */
    protected $listId;

    public function __construct(RequestStack $requestStack, Client $mailChimpClient, string $listId)
    {
        $this->requestStack = $requestStack;
        $this->mailChimpClient = $mailChimpClient;
        $this->listId = $listId;
    }

    public function subscribe(string $email, string $firstName, string $lastName)
    {
        try {
            $this->mailChimpClient->post(
                sprintf('/3.0/lists/%s/members', $this->listId),
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

    protected function getLocale() : string
    {
        return $this->requestStack->getMasterRequest()->getLocale();
    }
}
