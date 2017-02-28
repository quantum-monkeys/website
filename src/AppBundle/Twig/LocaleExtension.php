<?php

namespace AppBundle\Twig;

use AppBundle\Manager\LocaleManager;

/**
 * ImageExtension
 */
class LocaleExtension extends \Twig_Extension
{
    /**
     * @var LocaleManager
     */
    protected $localeManager;

    /**
     * @param LocaleManager $localeManager
     */
    public function __construct(LocaleManager $localeManager) {
        $this->localeManager = $localeManager;
    }

    public function getFunctions()
    {
        return array(
            'languageName' => new \Twig_Function_Method($this, 'getLanguageName'),
        );
    }

    public function getLanguageName(string $locale): string
    {
        return $this->localeManager->getLanguageName($locale);
    }

    /**
     * {@inheritdoc}
     */
    public function getName() {
        return 'twig_locale';
    }
}
