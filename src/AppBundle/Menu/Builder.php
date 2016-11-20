<?php

namespace AppBundle\Menu;

use Knp\Menu\FactoryInterface;

class Builder
{
    public function mainMenu(FactoryInterface $factory, array $options)
    {
        $menu = $factory->createItem('root');

        $menu->addChild('home', ['route' => 'homepage'])->setExtra('translation_domain', 'menu');
        $menu->addChild('services', ['route' => 'service_list'])->setExtra('translation_domain', 'menu');
        $menu->addChild('academy', ['route' => 'academy_index'])->setExtra('translation_domain', 'menu');
        $menu->addChild('events', ['route' => 'event_list'])->setExtra('translation_domain', 'menu');
        $menu->addChild('discounts', ['route' => 'discount_list'])->setExtra('translation_domain', 'menu');
        $menu->addChild('about_us', ['route' => 'about_us'])->setExtra('translation_domain', 'menu');
        $menu->addChild('blog', ['route' => 'blog'])->setExtra('translation_domain', 'menu');
        $menu->addChild('contact_us', ['uri' => '#contact-us'])->setExtra('translation_domain', 'menu');

        return $menu;
    }
}
