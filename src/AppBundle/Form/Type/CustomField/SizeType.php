<?php

namespace AppBundle\Form\Type\CustomField;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;

class SizeType extends AbstractType
{
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'translation_domain' => 'contact',
            'choices' => [
                '1-10' => 'form.size.placeholders.1-10',
                '10-20' => 'form.size.placeholders.10-20',
                '20-50' => 'form.size.placeholders.20-50',
                '50-100' => 'form.size.placeholders.50-100',
                '100-200' => 'form.size.placeholders.100-200',
                '200-500' => 'form.size.placeholders.200-500',
                '500-more' => 'form.size.placeholders.500-more',
            ]
        ]);
    }

    public function getParent()
    {
        return ChoiceType::class;
    }
}
