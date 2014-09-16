<?php

namespace FDevs\StaticPageBundle\DependencyInjection;

use Symfony\Component\Config\Definition\Builder\ArrayNodeDefinition;
use Symfony\Component\Config\Definition\Builder\TreeBuilder;
use Symfony\Component\Config\Definition\ConfigurationInterface;

/**
 * This is the class that validates and merges configuration from your app/config files
 *
 * To learn more see {@link http://symfony.com/doc/current/cookbook/bundles/extension.html#cookbook-bundles-extension-config-class}
 */
class Configuration implements ConfigurationInterface
{
    /**
     * {@inheritDoc}
     */
    public function getConfigTreeBuilder()
    {
        $treeBuilder = new TreeBuilder();
        $rootNode = $treeBuilder->root('f_devs_static_page');

        $supportType = ['_template', '_controller'];
        $rootNode
            ->children()
                ->arrayNode('pages')
                    ->useAttributeAsKey('name')
                    ->prototype('array')
                        ->children()
                            ->scalarNode('type')
                                ->defaultValue('_template')
                                ->validate()
                                ->ifNotInArray($supportType)
                                ->thenInvalid('The admin service %s is not supported. Please choose one of ' . json_encode($supportType))
                                ->end()
                            ->end()
                            ->scalarNode('value')->isRequired()->end()
                        ->end()
                    ->end()
                ->end()
            ->end();

        $this->addAdminServiceNode($rootNode);
        $this->addDbDriverNode($rootNode);

        return $treeBuilder;
    }

    /**
     * add Admin Service Node
     *
     * @param ArrayNodeDefinition $node
     *
     * @return mixed
     */
    private function addAdminServiceNode(ArrayNodeDefinition $node)
    {
        $supportedAdminService = ['sonata'];

        return $node
                ->children()
                    ->scalarNode('admin_service')
                    ->defaultNull()
                        ->validate()
                        ->ifNotInArray($supportedAdminService)
                        ->thenInvalid('The admin service %s is not supported. Please choose one of ' . json_encode($supportedAdminService))
                        ->end()
                    ->end()
                ->end();
    }

    /**
     * add DbDriver Node
     *
     * @param ArrayNodeDefinition $node
     *
     * @return mixed
     */
    private function addDbDriverNode(ArrayNodeDefinition $node)
    {
        $supportedDrivers = ['mongodb'];

        return $node
            ->children()
                ->scalarNode('manager_name')->defaultNull()->end()
                ->scalarNode('model_class')->defaultValue('FDevs\StaticPageBundle\Model\StaticPage')->end()
                ->arrayNode('form')
                    ->addDefaultsIfNotSet()
                    ->children()
                        ->scalarNode('type')->defaultValue('fdevs_static_type')->end()
                        ->scalarNode('class')->defaultValue('FDevs\StaticPageBundle\Form\Type\StaticTypeType')->end()
                    ->end()
                ->end()
                ->scalarNode('db_driver')->defaultValue('mongodb')
                    ->validate()
                    ->ifNotInArray($supportedDrivers)
                    ->thenInvalid('The driver %s is not supported. Please choose one of ' . json_encode($supportedDrivers))
                    ->end()
                ->end()
            ->end();
    }
}
