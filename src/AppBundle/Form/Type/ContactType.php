<?php

namespace AppBundle\Form\Type;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\OptionsResolver\OptionsResolver;

class ContactType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('firstName', TextType::class, [
                'attr' => [
                    'placeholder' => 'form.placeholders.firstname'
                ],
            ])
            ->add('lastName', TextType::class, [
                'attr' => [
                    'placeholder' => 'form.placeholders.lastname'
                ],
            ])
            ->add('email', EmailType::class, [
                'attr' => [
                    'placeholder' => 'form.placeholders.email'
                ],
            ])
            ->add('project', TextType::class, [
                'attr' => [
                    'placeholder' => 'form.placeholders.project'
                ],
                'required' => false,
            ])
            ->add('message', TextareaType::class, [
                'attr' => [
                    'placeholder' => 'form.placeholders.message'
                ],
            ])
            ->add('submit', SubmitType::class, [
                'label' => 'form.label.submit'
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'translation_domain' => 'contact'
        ]);
    }
}
