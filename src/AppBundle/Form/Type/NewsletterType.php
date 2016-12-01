<?php

namespace AppBundle\Form\Type;

use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;

class NewsletterType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('email', EmailType::class, [
                'attr' => [
                    'placeholder' => 'form.email.placeholder'
                ],
            ])
            ->add('firstName', TextType::class, [
                'attr' => [
                    'placeholder' => 'form.first_name.placeholder'
                ],
            ])
            ->add('lastName', TextType::class, [
                'attr' => [
                    'placeholder' => 'form.last_name.placeholder'
                ],
            ])
            ->add('submit', SubmitType::class, array(
                'label' => 'form.submit.placeholder'
            ))
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'translation_domain' => 'newsletter'
        ]);
    }
}
