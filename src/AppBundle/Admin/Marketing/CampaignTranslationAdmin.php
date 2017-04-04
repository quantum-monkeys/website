<?php

namespace AppBundle\Admin\Marketing;

use Sonata\AdminBundle\Admin\Admin;
use Sonata\AdminBundle\Form\FormMapper;

class CampaignTranslationAdmin extends Admin
{
    protected function configureFormFields(FormMapper $formMapper)
    {
        $formMapper
            ->with('Landing Page')
                ->add('title', 'text')
                ->add('subTitle', 'text')
                ->add('slug', 'text', [
                    'read_only' => true,
                    'help' => 'Will be automatically generated'
                ])
                ->add('mainContent', 'sonata_simple_formatter_type', [
                    'format' => 'markdown',
                ])
                ->add('mainPicture', 'sonata_media_type', [
                    'required' => false,
                    'context' => 'default',
                    'provider' => 'sonata.media.provider.image',
                ])
            ->end()
            ->with('Landing Page Form')
                ->add('mainFormTitle', 'text')
                ->add('mainSubmitButtonLabel', 'text')
                ->add('mainSuccessMessage', 'text')
            ->end()
            ->with('First Email')
                ->add('firstEmailSubject', 'text')
                ->add('firstEmailContent', 'sonata_simple_formatter_type', [
                    'format' => 'markdown',
                    'help' => 'You can use %firstname%, %lastname%, %email%, %company%, %document_url% and %contact_url%'
                ])
                ->add('document', 'sonata_media_type', [
                    'required' => false,
                    'context' => 'default',
                    'provider' => 'sonata.media.provider.file',
                ])
            ->end()
            ->with('Contact Page')
                ->add('contactContent', 'sonata_simple_formatter_type', [
                    'format' => 'markdown',
                ])
                ->add('contactFormTitle', 'text')
                ->add('contactSubmitButtonLabel', 'text')
                ->add('contactSuccessMessage', 'text')
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
