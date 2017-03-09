<?php

namespace AppBundle\Admin;

use AppBundle\Entity\EventOccurrenceCost;
use AppBundle\Entity\Person;
use AppBundle\Entity\PersonTranslation;
use Sonata\AdminBundle\Admin\Admin;
use Sonata\AdminBundle\Datagrid\DatagridMapper;
use Sonata\AdminBundle\Datagrid\ListMapper;
use Sonata\AdminBundle\Form\FormMapper;

class LandingPageAdmin extends Admin
{
    protected function configureFormFields(FormMapper $formMapper)
    {
        $formMapper
            ->add('translations', 'sonata_type_collection', [
                'by_reference' => false,
            ], [
                'edit' => 'standard',
                'inline' => 'table',
                'admin_code' => 'admin.landing_page_translation',
            ])
        ;
    }

    protected function configureDatagridFilters(DatagridMapper $datagridMapper)
    {
//        $datagridMapper;
    }

    protected function configureListFields(ListMapper $listMapper)
    {
        $listMapper
            ->addIdentifier('title')
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
