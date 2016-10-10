<?php

namespace AppBundle\Menu;

use Knp\Menu\FactoryInterface;

class Builder
{
    public function mainMenu(FactoryInterface $factory, array $options)
    {
        $menu = $factory->createItem('root');

        $menu->addChild('menu.home', array('route' => 'homepage'));
        $menu->addChild('menu.services', array('route' => 'service_list'));
        $menu->addChild('menu.trainings', array('route' => 'training_list'));
        $menu->addChild('menu.events', array('route' => 'event_list'));
        $menu->addChild('menu.about_us', array('route' => 'about_us'));
        $menu->addChild('menu.old_home', array('route' => 'old_homepage'));

        return $menu;
    }
}
