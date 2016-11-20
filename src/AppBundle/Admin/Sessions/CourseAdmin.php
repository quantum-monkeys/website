<?php

namespace AppBundle\Admin\Sessions;

use Sonata\AdminBundle\Datagrid\DatagridMapper;
use Sonata\AdminBundle\Datagrid\ListMapper;
use Sonata\AdminBundle\Form\FormMapper;

class CourseAdmin extends SessionAdmin
{
    protected function configureFormFields(FormMapper $formMapper)
    {
        $formMapper
            ->add('begin', 'datetime')
            ->add('end', 'datetime')
            ->add('modules')
            ->add('trainers')
        ;
    }

    protected function configureDatagridFilters(DatagridMapper $datagridMapper)
    {
    }

    protected function configureListFields(ListMapper $listMapper)
    {
        $listMapper
            ->addIdentifier('id')
            ->add('begin')
            ->add('end')
            ->add('modules')
            ->add('trainers')
        ;
    }
}
