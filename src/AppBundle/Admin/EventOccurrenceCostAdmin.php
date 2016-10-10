<?php

namespace AppBundle\Admin;

use Sonata\AdminBundle\Admin\Admin;
use Sonata\AdminBundle\Datagrid\DatagridMapper;
use Sonata\AdminBundle\Datagrid\ListMapper;
use Sonata\AdminBundle\Form\FormMapper;

class EventOccurrenceCostAdmin extends Admin
{
    protected function configureFormFields(FormMapper $formMapper)
    {
        $formMapper
            ->add('name', 'text')
            ->add('cost', 'number')
            ->add('currency', 'currency', [
                'choices' => [
                    'Canadian Dollar' => 'CAD',
                    'US Dollar' => 'USD',
                    'Euro' => 'EUR',
                ],
                'data' => 'CAD'
            ])
        ;
    }
}
