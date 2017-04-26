<?php

/*
 * This file is part of the Sonata Project package.
 *
 * (c) Thomas Rabaix <thomas.rabaix@sonata-project.org>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Application\Sonata\NewsBundle\Admin;

use Sonata\AdminBundle\Datagrid\ListMapper;
use Sonata\AdminBundle\Form\FormMapper;
use Sonata\NewsBundle\Admin\PostAdmin as BasePostAdmin;

class PostAdmin extends BasePostAdmin
{
    /**
     * {@inheritdoc}
     */
    protected function configureListFields(ListMapper $listMapper)
    {
        parent::configureListFields($listMapper);

        $listMapper
            ->add('lang', 'string');
    }

    protected function configureFormFields(FormMapper $formMapper)
    {
        parent::configureFormFields($formMapper);

        $formMapper
            ->with('group_lang', array(
                'class' => 'col-md-4',
            ))
                ->add('lang', 'language', [
                    'choices' => [
                        'English' => 'en',
                        'Français' => 'fr',
                    ],
                    'multiple' => false,
                    'expanded'=> true,
                ])
            ->end()
        ;
    }
}
