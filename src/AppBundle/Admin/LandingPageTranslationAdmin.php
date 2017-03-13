<?php

namespace AppBundle\Admin;

use Sonata\AdminBundle\Admin\Admin;
use Sonata\AdminBundle\Form\FormMapper;

class LandingPageTranslationAdmin extends Admin
{
    protected function configureFormFields(FormMapper $formMapper)
    {
        $formMapper
            ->with('Content')
                ->add('title', 'text')
                ->add('slug', 'text', [
                    'read_only' => true,
                    'help' => 'Will be automatically generated'
                ])
                ->add('picture', 'sonata_media_type', [
                    'required' => false,
                    'context' => 'default',
                    'provider' => 'sonata.media.provider.image',
                ])
                ->add('intro', 'sonata_simple_formatter_type', [
                    'format' => 'markdown',
                ])
            ->end()
            ->with('Form')
                ->add('formTitle', 'text')
                ->add('submitButtonLabel', 'text')
                ->add('successMessage', 'text')
            ->end()
            ->with('Email')
                ->add('emailSubject', 'text')
                ->add('emailContent', 'sonata_simple_formatter_type', [
                    'format' => 'markdown',
                    'help' => 'You can use %firstname%, %lastname%, %email%, %company% and %document_url%'
                ])
                ->add('document', 'sonata_media_type', [
                    'required' => false,
                    'context' => 'default',
                    'provider' => 'sonata.media.provider.file',
                ])
            ->end()
            ->with('Settings')
                ->add('locale', 'language', [
                    'choices' => [
                        'English' => 'en',
                        'Français' => 'fr',
                    ],
                ])
            ->end()
        ;
    }
}
