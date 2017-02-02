<?php

namespace AppBundle\Admin;

use AppBundle\Entity\EventOccurrenceCost;
use Sonata\AdminBundle\Admin\Admin;
use Sonata\AdminBundle\Datagrid\DatagridMapper;
use Sonata\AdminBundle\Datagrid\ListMapper;
use Sonata\AdminBundle\Form\FormMapper;

abstract class PackageAdmin extends Admin
{
    protected function configureFormFields(FormMapper $formMapper)
    {
        $formMapper
            ->add('position', 'number', [
                'required' => false
            ])
            ->add('price', 'number', [
                'required' => false,
            ])
            ->add('service')
            ->add('remote', null, [
                'required' => false,
            ])
            ->add('onSite', null, [
                'required' => false,
            ])
            ->add('duration')
            ->add('emergencyCalls')
            ->add('emails')
            ->add('minimalEngagement')
            ->add('translations', 'sonata_type_collection', [
                'by_reference' => false,
            ], [
                'edit' => 'inline',
                'admin_code' => 'admin.package_translation',
            ])
        ;
    }

    protected function configureDatagridFilters(DatagridMapper $datagridMapper)
    {
        $datagridMapper
            ->add('name')
        ;
    }

    protected function configureListFields(ListMapper $listMapper)
    {
        $listMapper
            ->addIdentifier('name')
        ;
    }
}
