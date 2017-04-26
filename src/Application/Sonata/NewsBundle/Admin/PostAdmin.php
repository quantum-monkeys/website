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
            ->add('custom', 'string', array(
                'template' => 'ApplicationSonataNewsBundle:Admin:list_post_custom.html.twig',
                'label' => 'Post',
                'sortable' => 'title',
            ));
    }
}
