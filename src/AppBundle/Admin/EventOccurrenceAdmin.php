<?php

namespace AppBundle\Admin;

use AppBundle\Entity\EventOccurrenceCost;
use Sonata\AdminBundle\Admin\Admin;
use Sonata\AdminBundle\Datagrid\DatagridMapper;
use Sonata\AdminBundle\Datagrid\ListMapper;
use Sonata\AdminBundle\Form\FormMapper;

class EventOccurrenceAdmin extends Admin
{
    protected function configureFormFields(FormMapper $formMapper)
    {
        $formMapper
            ->add('begin', 'datetime')
            ->add('end', 'datetime')
            ->add('remainingSeats', 'integer')
            ->add('eventBriteLink', 'text', [
                'required' => false,
            ])
            ->add('location', 'entity', [
                'class' => 'AppBundle\Entity\Location',
                'choice_label' => 'name',
            ])
            ->add('event', 'entity', [
                'class' => 'AppBundle\Entity\Event',
                'choice_label' => 'name',
            ])
            ->add('costs', 'sonata_type_collection', [], [
                'edit' => 'inline',
                'inline' => 'table',
                'sortable'  => 'position',
                'by_reference' => true,
                'admin_code' => 'admin.event_occurrence_cost',
            ])
            ->add('free', 'checkbox', [
                'required' => false,
            ])
            ->add('speakers', 'sonata_type_model', [
                'multiple' => true,
                'by_reference' => false
            ])
            ->add('languages', 'language', [
                'choices' => [
                    'English' => 'en',
                    'Français' => 'fr',
                ],
                'multiple' => true,
                'expanded'=> true,
            ])
            ->add('translations', 'sonata_type_collection', [
                'by_reference' => false,
            ], [
                'edit' => 'inline',
                'inline' => 'table',
                'admin_code' => 'admin.event_occurrence_translation',
            ])
            ->add('picture', 'sonata_media_type', [
                'required' => false,
                'context' => 'default',
                'provider' => 'sonata.media.provider.image',
            ])
        ;
    }

    protected function configureDatagridFilters(DatagridMapper $datagridMapper)
    {
        $datagridMapper
            ->add('begin')
            ->add('end')
        ;
    }

    protected function configureListFields(ListMapper $listMapper)
    {
        $listMapper
            ->addIdentifier('id')
            ->addIdentifier('name')
        ;
    }

    public function prePersist($object)
    {
        $object->setCosts($object->getCosts());

        /** @var EventOccurrenceCost $cost */
        foreach ($object->getCosts() as $cost) {
            $cost->setEventOccurrence($object);
        }
    }

    public function preUpdate($object)
    {
        $object->setCosts($object->getCosts());

        /** @var EventOccurrenceCost $cost */
        foreach ($object->getCosts() as $cost) {
            $cost->setEventOccurrence($object);
        }
    }
}
