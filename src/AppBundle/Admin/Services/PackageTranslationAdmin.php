<?php

namespace AppBundle\Admin\Services;

use Sonata\AdminBundle\Admin\Admin;
use Sonata\AdminBundle\Datagrid\DatagridMapper;
use Sonata\AdminBundle\Datagrid\ListMapper;
use Sonata\AdminBundle\Form\FormMapper;

class PackageTranslationAdmin extends Admin
{
    protected function configureFormFields(FormMapper $formMapper)
    {
        $formMapper
            ->add('name', 'text')
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
