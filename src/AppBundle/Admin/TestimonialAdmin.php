<?php

namespace AppBundle\Admin;

use AppBundle\Entity\EventOccurrenceCost;
use Sonata\AdminBundle\Admin\Admin;
use Sonata\AdminBundle\Datagrid\DatagridMapper;
use Sonata\AdminBundle\Datagrid\ListMapper;
use Sonata\AdminBundle\Form\FormMapper;

class TestimonialAdmin extends Admin
{
    protected function configureFormFields(FormMapper $formMapper)
    {
        $formMapper
            ->add('person', 'entity', [
                'class' => 'AppBundle\Entity\Person',
                'choice_label' => 'displayName',
            ])
            ->add('content', 'sonata_simple_formatter_type', array(
                'format' => 'markdown',
            ))
        ;
    }

    protected function configureDatagridFilters(DatagridMapper $datagridMapper)
    {
        $datagridMapper
            ->add('person.firstName')
            ->add('person.lastName')
        ;
    }

    protected function configureListFields(ListMapper $listMapper)
    {
        $listMapper
            ->addIdentifier('person.displayName')
        ;
    }
}
