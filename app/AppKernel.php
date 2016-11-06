<?php

use Symfony\Component\HttpKernel\Kernel;
use Symfony\Component\Config\Loader\LoaderInterface;

class AppKernel extends Kernel
{
    public function registerBundles()
    {
        $bundles = array(
            new Symfony\Bundle\FrameworkBundle\FrameworkBundle(),
            new Symfony\Bundle\SecurityBundle\SecurityBundle(),
            new Symfony\Bundle\TwigBundle\TwigBundle(),
            new Symfony\Bundle\MonologBundle\MonologBundle(),
            new Symfony\Bundle\SwiftmailerBundle\SwiftmailerBundle(),
            new Doctrine\Bundle\DoctrineBundle\DoctrineBundle(),
            new Sensio\Bundle\FrameworkExtraBundle\SensioFrameworkExtraBundle(),

            new Knp\Bundle\MenuBundle\KnpMenuBundle(),
            new JMS\I18nRoutingBundle\JMSI18nRoutingBundle(),
            new Lexik\Bundle\TranslationBundle\LexikTranslationBundle(),

            new Sonata\CoreBundle\SonataCoreBundle(),
            new Sonata\BlockBundle\SonataBlockBundle(),
            new Sonata\DoctrineORMAdminBundle\SonataDoctrineORMAdminBundle(),
            new Sonata\EasyExtendsBundle\SonataEasyExtendsBundle(),
            new Sonata\AdminBundle\SonataAdminBundle(),
            new Sonata\IntlBundle\SonataIntlBundle(),
            new Sonata\ClassificationBundle\SonataClassificationBundle(),
            new Sonata\SeoBundle\SonataSeoBundle(),
            new Application\Sonata\ClassificationBundle\ApplicationSonataClassificationBundle(),
            new Sonata\MediaBundle\SonataMediaBundle(),
            new JMS\SerializerBundle\JMSSerializerBundle(),
            new Application\Sonata\MediaBundle\ApplicationSonataMediaBundle(),

//            new Sonata\MarkItUpBundle\SonataMarkItUpBundle(),
            new Ivory\CKEditorBundle\IvoryCKEditorBundle(),
            new Sonata\NewsBundle\SonataNewsBundle(),
            new FOS\UserBundle\FOSUserBundle(),
            new Sonata\UserBundle\SonataUserBundle('FOSUserBundle'),
            new Sonata\FormatterBundle\SonataFormatterBundle(),
            new Knp\Bundle\MarkdownBundle\KnpMarkdownBundle(),
            new Application\Sonata\UserBundle\ApplicationSonataUserBundle(),
            new Application\Sonata\NewsBundle\ApplicationSonataNewsBundle(),

            new Accord\MandrillSwiftMailerBundle\AccordMandrillSwiftMailerBundle(),

            new Hype\MailchimpBundle\HypeMailchimpBundle(),

            new AppBundle\AppBundle(),
        );

        if (in_array($this->getEnvironment(), array('dev', 'test'), true)) {
            $bundles[] = new Symfony\Bundle\DebugBundle\DebugBundle();
            $bundles[] = new Symfony\Bundle\WebProfilerBundle\WebProfilerBundle();
            $bundles[] = new Sensio\Bundle\DistributionBundle\SensioDistributionBundle();
            $bundles[] = new Sensio\Bundle\GeneratorBundle\SensioGeneratorBundle();

            $bundles[] = new Doctrine\Bundle\FixturesBundle\DoctrineFixturesBundle();
            $bundles[] = new Hautelook\AliceBundle\HautelookAliceBundle();
        }

        return $bundles;
    }

    public function registerContainerConfiguration(LoaderInterface $loader)
    {
        $loader->load($this->getRootDir().'/config/config_'.$this->getEnvironment().'.yml');
    }
}
