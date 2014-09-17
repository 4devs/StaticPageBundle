<?php

namespace FDevs\StaticPageBundle\DependencyInjection;

use Symfony\Component\DependencyInjection\ContainerBuilder;
use Symfony\Component\Config\FileLocator;
use Symfony\Component\HttpKernel\DependencyInjection\Extension;
use Symfony\Component\DependencyInjection\Loader;

/**
 * This is the class that loads and manages your bundle configuration
 *
 * To learn more see {@link http://symfony.com/doc/current/cookbook/bundles/extension.html}
 */
class FDevsStaticPageExtension extends Extension
{
    /**
     * {@inheritDoc}
     */
    public function load(array $configs, ContainerBuilder $container)
    {
        $configuration = new Configuration();
        $config = $this->processConfiguration($configuration, $configs);

        $container->setParameter($this->getAlias() . '.pages', $config['pages']);
        $container->setParameter($this->getAlias() . '.allowed_types', ['_template', '_controller']);
        $container->setParameter($this->getAlias() . '.manager_name', $config['manager_name']);
        $container->setParameter($this->getAlias() . '.form_type.type', $config['form']['type']);
        $container->setParameter($this->getAlias() . '.form_type.class', $config['form']['class']);
        $container->setParameter($this->getAlias() . '.model_class', $config['model_class']);

        $loader = new Loader\XmlFileLoader($container, new FileLocator(__DIR__ . '/../Resources/config'));
        $loader->load('services.xml');

        if ($config['db_driver']) {
            $loader->load(sprintf('%s.xml', $config['db_driver']));
            $container->setParameter($this->getAlias() . '.backend_type_' . $config['db_driver'], true);
        }

        if ($config['admin_service']) {
            $loader->load('admin/' . $config['admin_service'] . '.xml');
        }

    }
}
