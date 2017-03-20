<?php

namespace AppBundle\Admin\Marketing;

use Sonata\AdminBundle\Admin\Admin;
use Sonata\AdminBundle\Datagrid\DatagridMapper;
use Sonata\AdminBundle\Datagrid\ListMapper;
use Sonata\AdminBundle\Route\RouteCollection;
use Sonata\AdminBundle\Show\ShowMapper;

class ContactAdmin extends Admin
{
    protected function configureRoutes(RouteCollection $collection)
    {
        $collection->clearExcept(array('list', 'show'));
    }

    protected function configureShowFields(ShowMapper $showMapper)
    {
        $showMapper
            ->add('firstName', 'text')
            ->add('lastName', 'text')
            ->add('email', 'text')
            ->add('company.name', 'text')
            ->add('jobTitle', 'text')
            ->add('contactReason', 'array')
        ;
    }

    protected function configureDatagridFilters(DatagridMapper $datagridMapper)
    {
        $datagridMapper
            ->add('firstName')
            ->add('lastName')
            ->add('email')
            ->add('company.name')
            ->add('landingPageTranslation')
        ;
    }

    protected function configureListFields(ListMapper $listMapper)
    {
        $listMapper
            ->addIdentifier('displayName', null, array(
                'route' => array(
                    'name' => 'show'
                )
            ))
            ->add('email')
            ->add('company.name')
            ->add('campaignTranslation')
        ;
    }


    public function prePersist($object)
    {
        $this->preUpdate($object);
    }

    public function preUpdate($object)
    {
        $object->setTranslations($object->getTranslations());
    }
}
