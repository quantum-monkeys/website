<?php
namespace AppBundle\Twig;

use AppBundle\Manager\MediaManager;
use Application\Sonata\MediaBundle\Entity\Media;

class MediaExtension extends \Twig_Extension
{
    /**
     *
     * @var MediaManager
     */
    protected $mediaManager;

    public function __construct(MediaManager $mediaManager)
    {
        $this->mediaManager = $mediaManager;
    }

    public function getFunctions()
    {
        return array(
            new \Twig_SimpleFunction('absolute_path', array($this, 'getAbsolutePath')),
        );
    }

    public function getAbsolutePath(Media $media, $format)
    {
        return $this->mediaManager->getPublicPath($media, $format);
    }
}
