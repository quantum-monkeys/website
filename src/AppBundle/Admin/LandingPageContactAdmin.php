<?php

namespace AppBundle\Admin;

use Sonata\AdminBundle\Admin\Admin;
use Sonata\AdminBundle\Datagrid\DatagridMapper;
use Sonata\AdminBundle\Datagrid\ListMapper;
use Sonata\AdminBundle\Route\RouteCollection;
use Sonata\AdminBundle\Show\ShowMapper;

class LandingPageContactAdmin extends Admin
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
            ->add('company', 'text')
            ->add('email', 'text')
        ;
    }

    protected function configureDatagridFilters(DatagridMapper $datagridMapper)
    {
        $datagridMapper
            ->add('firstName')
            ->add('lastName')
            ->add('email')
            ->add('company')
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
            ->add('company')
            ->add('landingPageTranslation')
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
