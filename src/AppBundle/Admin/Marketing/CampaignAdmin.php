<?php

namespace AppBundle\Admin\Marketing;

use AppBundle\Entity\Marketing\Campaign;
use AppBundle\Manager\MailchimpListManager;
use Sonata\AdminBundle\Admin\Admin;
use Sonata\AdminBundle\Datagrid\DatagridMapper;
use Sonata\AdminBundle\Datagrid\ListMapper;
use Sonata\AdminBundle\Form\FormMapper;

class CampaignAdmin extends Admin
{
    /**
     * @var MailchimpListManager
     */
    protected $mailchimpListManager;

    /**
     * @param string $code
     * @param string $class
     * @param string $baseControllerName
     * @param MailchimpListManager $mailchimpListManager
     */
    public function __construct($code, $class, $baseControllerName, MailchimpListManager $mailchimpListManager)
    {
        parent::__construct($code, $class, $baseControllerName);

        $this->mailchimpListManager = $mailchimpListManager;
    }

    protected function configureFormFields(FormMapper $formMapper)
    {
        $formMapper
            ->add('title', 'text')
            ->add('author', 'entity', [
                'class' => 'AppBundle\Entity\Person',
                'choice_label' => 'displayName',
            ])
            ->add('translations', 'sonata_type_collection', [
                'by_reference' => false,
            ], [
                'edit' => 'inline',
                'inline' => 'standard',
                'admin_code' => 'admin.marketing.campaign_translation',
            ])
        ;
    }

    protected function configureDatagridFilters(DatagridMapper $datagridMapper)
    {
    }

    protected function configureListFields(ListMapper $listMapper)
    {
        $listMapper
            ->addIdentifier('title')
        ;
    }

    /**
     * @param Campaign $object
     */
    public function prePersist($object)
    {
        $this->preUpdate($object);
    }

    /**
     * @param Campaign $object
     */
    public function preUpdate($object)
    {
        $object->setTranslations($object->getTranslations());

        foreach ($object->getTranslations() as $translation) {
            if ($translation->getMailChimpListId() === null) {
                $translation->setMailChimpListId($this->mailchimpListManager->create($translation->getTitle(), $translation->getLocale()));
            }
        }
    }
}
