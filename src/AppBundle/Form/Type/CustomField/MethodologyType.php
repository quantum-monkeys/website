<?php

namespace AppBundle\Form\Type\CustomField;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;

class MethodologyType extends AbstractType
{
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'translation_domain' => 'contact',
            'choices' => [
                'waterfall' => 'form.methodology.placeholders.waterfall',
                'lean' => 'form.methodology.placeholders.lean',
                'agile' => 'form.methodology.placeholders.agile',
            ]
        ]);
    }

    public function getParent()
    {
        return ChoiceType::class;
    }
}
