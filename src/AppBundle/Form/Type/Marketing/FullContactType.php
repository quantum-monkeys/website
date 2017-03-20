<?php

namespace AppBundle\Form\Type\Marketing;

use AppBundle\Entity\Marketing\Contact;
use AppBundle\Form\Type\CustomField\ReasonType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\OptionsResolver\OptionsResolver;

class FullContactType extends AbstractType
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
            ->add('jobTitle', TextType::class, [
                'attr' => [
                    'placeholder' => 'form.placeholders.job_title'
                ],
            ])
            ->add('company', CompanyNameType::class)
            ->add('contactReason', ReasonType::class, [
                'multiple' => true,
                'expanded' => true,
                'label' => 'form.label.contact_reason'
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
            'translation_domain' => 'contact',
            'data_class' => Contact::class
        ]);
    }
}
