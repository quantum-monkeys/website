<?php

namespace AppBundle\Form\Type\Marketing;

use AppBundle\Entity\Marketing\Company;
use AppBundle\Form\Type\CustomField\MethodologyType;
use AppBundle\Form\Type\CustomField\SizeType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class CompanyType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('name', TextType::class, [
                'attr' => [
                    'placeholder' => 'form.placeholders.company.name'
                ],
            ])
            ->add('size', SizeType::class, [
                'attr' => [
                    'placeholder' => 'form.placeholders.company.size'
                ],
            ])
            ->add('methodology', MethodologyType::class, [
                'attr' => [
                    'placeholder' => 'form.placeholders.company.methodology'
                ],
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'translation_domain' => 'contact',
            'data_class' => Company::class
        ]);
    }
}
