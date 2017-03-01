<?php

namespace AppBundle\Manager;

use AppBundle\Interfaces\TranslatableInterface;
use Symfony\Component\HttpFoundation\RequestStack;
use Symfony\Component\PropertyAccess\PropertyAccess;

class ObjectTranslator
{
    protected $requestStack;
    /**
     * @var \Symfony\Component\PropertyAccess\PropertyAccessor
     */
    protected $propertyAccessor;

    public function __construct(RequestStack $requestStack)
    {
        $this->requestStack = $requestStack;
        $this->propertyAccessor = PropertyAccess::createPropertyAccessor();
    }

    public function translate(TranslatableInterface $object, $key)
    {
        $defaultLocale = $this->requestStack->getMasterRequest()->getDefaultLocale();
        $locale = $this->requestStack->getMasterRequest()->getLocale() ?? $defaultLocale;

        $array = $object->getTranslations();

        if (!is_array($array) && method_exists($array, 'toArray')) {
            $array = $array->toArray();
        } elseif (!is_array($array)) {
            throw new \Exception('Translation need an array or an object wich implements "toArray"');
        }

        if (isset($array[$locale])) {
            return $this->propertyAccessor->getValue($array[$locale], $key);
        }

        if (isset($array[$defaultLocale])) {
            return $this->propertyAccessor->getValue($array[$defaultLocale], $key);
        }

        return null;
    }
}
