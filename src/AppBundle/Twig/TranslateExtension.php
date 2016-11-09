<?php
namespace AppBundle\Twig;

use AppBundle\Interfaces\TranslatableInterface;
use AppBundle\Manager\ObjectTranslator;

class TranslateExtension extends \Twig_Extension
{
    /**
     *
     * @var string
     */
    protected $locale;

    /**
     *
     * @var string
     */
    protected $defaultLocale;

    /**
     *
     * @var ObjectTranslator
     */
    protected $objectTranslator;

    public function __construct(ObjectTranslator $objectTranslator)
    {
        $this->objectTranslator = $objectTranslator;
    }

    public function getFunctions()
    {
        return array(
            new \Twig_SimpleFunction('translate', array($this, 'translate')),
        );
    }

    public function translate(TranslatableInterface $object, $key)
    {
        return $this->objectTranslator->translate($object, $key);
    }

    public function getName()
    {
        return 'translate';
    }
}
