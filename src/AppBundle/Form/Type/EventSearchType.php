<?php

namespace AppBundle\Form\Type;

use AppBundle\Manager\LocationManager;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\CheckboxType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\LanguageType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\OptionsResolver\OptionsResolver;

class EventSearchType extends AbstractType
{
    protected $locationManager;

    public function __construct(LocationManager $locationManager)
    {
        $this->locationManager = $locationManager;
    }

    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('content', TextType::class, [
                'required' => false,
            ])
            ->add('city', ChoiceType::class, [
                'choices' => $this->getCityChoices(),
                'required' => false,
            ])
            ->add('lang', LanguageType::class, [
                'choices' => [
                    'English' => 'en',
                    'Français' => 'fr',
                ],
                'required' => false,
            ])
            ->add('free', CheckboxType::class, [
                'required' => false,
            ])
            ->add('submit', SubmitType::class, array(
                'label' => 'events.form.placeholders.submit'
            ))
        ;
    }

    public function getCityChoices()
    {
        $choices = [];

        foreach ($this->locationManager->getAvailableCities() as $city) {
            $choices[$city] = $city;
        }

        return $choices;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'csrf_protection' => false,
        ]);
    }
}
