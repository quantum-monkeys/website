<?php

namespace AppBundle\Admin;

use Sonata\AdminBundle\Admin\Admin;
use Sonata\AdminBundle\Datagrid\DatagridMapper;
use Sonata\AdminBundle\Datagrid\ListMapper;
use Sonata\AdminBundle\Form\FormMapper;

class EventTranslationAdmin extends Admin
{
    protected function configureFormFields(FormMapper $formMapper)
    {
        $formMapper
            ->add('name', 'text')
            ->add('intro', 'sonata_simple_formatter_type', array(
                'format' => 'markdown',
                'required' => false,
            ))
            ->add('description', 'sonata_simple_formatter_type', array(
                'format' => 'markdown',
            ))
            ->add('locale', 'language', [
                'choices' => [
                    'English' => 'en',
                    'Français' => 'fr',
                ],
            ])
        ;
    }
}
