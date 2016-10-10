<?php

namespace AppBundle\Form\Type;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;

class ContactType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('name', 'text')
            ->add('email', 'email')
            ->add('subject', 'text')
            ->add('message', 'textarea')
            ->add('submit', SubmitType::class, array(
                'label' => 'contactus.form.placeholders.submit'
            ))
        ;
    }
}