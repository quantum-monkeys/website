<?php

namespace AppBundle\Admin\Services;

use AppBundle\Admin\PackageAdmin;
use Sonata\AdminBundle\Datagrid\DatagridMapper;
use Sonata\AdminBundle\Datagrid\ListMapper;
use Sonata\AdminBundle\Form\FormMapper;

class ExtraDevelopmentPackageAdmin extends PackageAdmin
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
            ->add('duration', 'integer')
            ->add('minimalEngagement')
            ->add('translations', 'sonata_type_collection', [
                'by_reference' => false,
            ], [
                'edit' => 'inline',
                'admin_code' => 'admin.extra_development_package_translation',
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
