<?php

namespace AppBundle\Twig;

use Symfony\Component\Routing\Router;

/**
 * ImageExtension
 */
class LocaleExtension extends \Twig_Extension
{
    /**
     * @var Router
     */
    protected $router;

    /**
     * @param Router $router
     */
    public function __construct(Router $router) {
        $this->router = $router;
    }

    /**
     * {@inheritdoc}
     */
    public function getFunctions()
    {
        return array(
            'localeSwitch' => new \Twig_Function_Method($this, 'localeSwitch'),
            'languageName' => new \Twig_Function_Method($this, 'getLanguageName'),
        );
    }

    /**
     * Prepare route parameters for language switch.
     *
     * @param $sNewLocale
     * @param $requestAttributes
     *
     * @return array
     */
    public function localeSwitch($sNewLocale, $requestAttributes)
    {
        $requestAttributes['_route_params']['_locale'] = $sNewLocale;

        return $this->router->generate($requestAttributes['_route'], $requestAttributes['_route_params']);
    }

    public function getLanguageName(string $locale): string
    {
        return \Locale::getDisplayLanguage($locale);
    }

    /**
     * {@inheritdoc}
     */
    public function getName() {
        return 'twig_locale';
    }
}
