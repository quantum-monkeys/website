<?php

namespace AppBundle\Admin;

use Sonata\AdminBundle\Admin\Admin;
use Sonata\AdminBundle\Form\FormMapper;

class LandingPageTranslationAdmin extends Admin
{
    protected function configureFormFields(FormMapper $formMapper)
    {
        $formMapper
            ->add('title', 'text')
            ->add('slug', 'text', [
                'read_only' => true
            ])
            ->add('picture', 'sonata_media_type', [
                'required' => false,
                'context' => 'default',
                'provider' => 'sonata.media.provider.image',
            ])
            ->add('intro', 'sonata_simple_formatter_type', array(
                'format' => 'markdown',
            ))
            ->add('formTitle', 'text')
            ->add('submitButtonLabel', 'text')
            ->add('successMessage', 'text')
            ->add('locale', 'language', [
                'choices' => [
                    'English' => 'en',
                    'Français' => 'fr',
                ],
            ])
        ;
    }
}
