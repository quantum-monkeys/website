<?php

namespace AppBundle\Manager;

use AppBundle\Interfaces\TranslatableInterface;
use Symfony\Component\HttpFoundation\RequestStack;
use Symfony\Component\PropertyAccess\PropertyAccess;

class ObjectTranslator
{
    /**
     *
     * @var string
     */
    protected $locale;

    /**
     *
     * @var string
     */
    protected $defaultLocale;

    /**
     * @var \Symfony\Component\PropertyAccess\PropertyAccessor
     */
    protected $propertyAccessor;

    public function __construct(RequestStack $requestStack)
    {
        if ($requestStack->getMasterRequest()) {
            $this->locale = $requestStack->getMasterRequest()->getLocale();
            $this->defaultLocale = $requestStack->getMasterRequest()->getDefaultLocale();
        }

        $this->propertyAccessor = PropertyAccess::createPropertyAccessor();
    }

    public function translate(TranslatableInterface $object, $key)
    {
        $array = $object->getTranslations();

        if (!is_array($array) && method_exists($array, 'toArray')) {
            $array = $array->toArray();
        } elseif (!is_array($array)) {
            throw new \Exception('Translation need an array or an object wich implements "toArray"');
        }
        if (isset($array[$this->locale])) {
            return $this->propertyAccessor->getValue($array[$this->locale], $key);
        }
        if (isset($array[$this->defaultLocale])) {
            return $this->propertyAccessor->getValue($array[$this->defaultLocale], $key);
        } else {
            throw new \Exception('Object key "'.$key.'" not translated');
        }
    }
}
