<?php

namespace AppBundle\DataFixtures\ORM;

use Hautelook\AliceBundle\Alice\DataFixtureLoader;

class AppFixturesLoader extends DataFixtureLoader
{
    /**
     * {@inheritDoc}
     */
    protected function getFixtures()
    {
        return  array(
            __DIR__ . '/Person.yml',
            __DIR__ . '/Testimonial.yml',
            __DIR__ . '/Service.yml',
            __DIR__ . '/Location.yml',
            __DIR__ . '/Training.yml',
            __DIR__ . '/Event.yml',
        );
    }
}
