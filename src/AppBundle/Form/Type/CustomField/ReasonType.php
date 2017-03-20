<?php

namespace AppBundle\Form\Type\CustomField;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;

class ReasonType extends AbstractType
{
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'translation_domain' => 'contact',
            'choices' => [
                'people_development' => 'form.reason.placeholders.people_development',
                'reorganization' => 'form.reason.placeholders.reorganization',
                'transition_lean_agile' => 'form.reason.placeholders.transition_lean_agile',
                'coaching' => 'form.reason.placeholders.coaching',
                'improve_culture' => 'form.reason.placeholders.improve_culture',
                'other' => 'form.reason.placeholders.other',
            ]
        ]);
    }

    public function getParent()
    {
        return ChoiceType::class;
    }
}
