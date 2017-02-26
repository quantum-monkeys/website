<?php

namespace AppBundle\Manager;

use Sonata\MediaBundle\Model\MediaInterface;
use Sonata\MediaBundle\Provider\Pool;

class MediaManager
{
    /**
     * @var Pool
     */
    protected $mediaService;

    public function __construct(Pool $mediaService)
    {
        $this->mediaService = $mediaService;
    }

    public function getPublicPath(MediaInterface $media, string $formatName): string
    {
        $provider = $this->mediaService->getProvider($media->getProviderName());
        $format = $provider->getFormatName($media, $formatName);

        return $provider->generatePublicUrl($media, $format);
    }
}
