<?php

namespace AppBundle\Manager;

use GuzzleHttp\Client;
use GuzzleHttp\Exception\BadResponseException;
use Symfony\Component\HttpFoundation\RequestStack;

abstract class MailchimpManager
{
    const SUCCESS = 'success';
    const UNKNOWN_ERROR = 'unknown_error';

    /**
     * @var RequestStack
     */
    protected $requestStack;

    /**
     * @var Client
     */
    protected $mailChimpClient;

    public function __construct(RequestStack $requestStack, Client $mailChimpClient)
    {
        $this->requestStack = $requestStack;
        $this->mailChimpClient = $mailChimpClient;
    }

    protected function getLocale(): string
    {
        return $this->requestStack->getMasterRequest()->getLocale();
    }
}
