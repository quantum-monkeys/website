<?php

namespace AppBundle\Admin;

use AppBundle\Entity\EventOccurrenceCost;
use AppBundle\Entity\Person;
use AppBundle\Entity\PersonTranslation;
use Sonata\AdminBundle\Admin\Admin;
use Sonata\AdminBundle\Datagrid\DatagridMapper;
use Sonata\AdminBundle\Datagrid\ListMapper;
use Sonata\AdminBundle\Form\FormMapper;

class PersonAdmin extends Admin
{
    protected function configureFormFields(FormMapper $formMapper)
    {
        $formMapper
            ->add('firstName', 'text')
            ->add('lastName', 'text')
//            ->add('position', 'text')
            ->add('company', 'text')
//            ->add('description', 'textarea')
            ->add('quantumMonkeysMember', 'checkbox', [
                'required' => false,
            ])
            ->add('picture', 'sonata_media_type', [
                'required' => false,
                'context' => 'default',
                'provider' => 'sonata.media.provider.image',
            ])
            ->add('translations', 'sonata_type_collection', [
                'by_reference' => false,
            ], [
                'edit' => 'inline',
                'inline' => 'table',
                'admin_code' => 'admin.person_translation',
            ])
        ;
    }

    protected function configureDatagridFilters(DatagridMapper $datagridMapper)
    {
        $datagridMapper
            ->add('firstName')
            ->add('lastName')
        ;
    }

    protected function configureListFields(ListMapper $listMapper)
    {
        $listMapper
            ->addIdentifier('displayName')
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
