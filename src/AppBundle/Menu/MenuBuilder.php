<?php

namespace AppBundle\Menu;

use AppBundle\Manager\LocaleManager;
use Knp\Menu\FactoryInterface;

class MenuBuilder
{
    private $factory;
    private $localeManager;

    public function __construct(FactoryInterface $factory, LocaleManager $localeManager)
    {
        $this->factory = $factory;
        $this->localeManager = $localeManager;
    }

    public function createMainMenu()
    {
        $targetLocale = $this->localeManager->getTargetLocale();
        $reverseUrl = $this->localeManager->generateReverseLocaleUrl();

        $menu = $this->factory->createItem('root');

        $menu->addChild('home', ['route' => 'homepage'])->setExtra('translation_domain', 'menu');
        $menu->addChild('services', ['route' => 'services'])->setExtra('translation_domain', 'menu');
//        $menu->addChild('coaching', ['route' => 'coaching'])->setExtra('translation_domain', 'menu');
//        $menu->addChild('academy', ['route' => 'academy'])->setExtra('translation_domain', 'menu');
//        $menu->addChild('studio', ['route' => 'studio'])->setExtra('translation_domain', 'menu');
//        $menu->addChild('events', ['route' => 'event_list'])->setExtra('translation_domain', 'menu');
        $menu->addChild('about_us', ['route' => 'about_us'])->setExtra('translation_domain', 'menu');
        $menu->addChild('blog', ['route' => 'blog'])->setExtra('translation_domain', 'menu');
        $menu->addChild('lang_switch.' . $targetLocale, ['uri' => $reverseUrl])->setExtra('translation_domain', 'menu');

        return $menu;
    }
}
