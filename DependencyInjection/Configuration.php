<?php

namespace Ekyna\Bundle\PayumPayzenBundle\DependencyInjection;

use Symfony\Component\Config\Definition\Builder\ArrayNodeDefinition;
use Symfony\Component\Config\Definition\Builder\TreeBuilder;
use Symfony\Component\Config\Definition\ConfigurationInterface;

/**
 * Class Configuration
 * @package Ekyna\Bundle\PayumPayzenBundle\DependencyInjection
 * @author  Etienne Dauvergne <contact@ekyna.com>
 */
class Configuration implements ConfigurationInterface
{
    /**
     * @inheritdoc
     */
    public function getConfigTreeBuilder()
    {
        $treeBuilder = new TreeBuilder();
        $root = $treeBuilder->root('ekyna_payum_payzen');

        $this->addApiSection($root);

        return $treeBuilder;
    }

    /**
     * Adds the api configuration section.
     *
     * @param ArrayNodeDefinition $node
     */
    public function addApiSection(ArrayNodeDefinition $node)
    {
        $node
            ->children()
                ->arrayNode('api')
                    ->addDefaultsIfNotSet()
                    ->children()
                        ->scalarNode('endpoint')
                            ->defaultNull()
                        ->end()
                        ->scalarNode('site_id')
                            ->isRequired()
                            ->cannotBeEmpty()
                        ->end()
                        ->scalarNode('certificate')
                            ->isRequired()
                            ->cannotBeEmpty()
                        ->end()
                        ->enumNode('ctx_mode')
                            ->values(['TEST', 'PRODUCTION'])
                        ->end()
                        ->scalarNode('directory')
                            ->cannotBeEmpty()
                            ->defaultValue('%kernel.root_dir%/../var/payzen')
                        ->end()
                        ->booleanNode('debug')
                            ->defaultValue('%kernel.debug%')
                        ->end()
                    ->end()
                ->end()
            ->end();
    }
}
