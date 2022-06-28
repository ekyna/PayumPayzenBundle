<?php

namespace Ekyna\Bundle\PayumPayzenBundle\DependencyInjection;

use Ekyna\Component\Payum\Payzen\Api\Api;
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
    public function getConfigTreeBuilder(): TreeBuilder
    {
        $builder = new TreeBuilder('ekyna_payum_payzen');

        $root = $builder->getRootNode();

        $this->addApiSection($root);

        return $builder;
    }

    /**
     * Adds the api configuration section.
     *
     * @param ArrayNodeDefinition $node
     */
    public function addApiSection(ArrayNodeDefinition $node): void
    {
        $node
            ->children()
                ->arrayNode('api')
                    ->addDefaultsIfNotSet()
                    ->children()
                        ->scalarNode('endpoint')
                            ->defaultNull()
                            ->validate()
                                ->ifNotInArray([null, Api::ENDPOINT_SYSTEMPAY, Api::ENDPOINT_SCELLIUS, Api::ENDPOINT_CLICANDPAY])
                                ->thenInvalid('Invalid api endpoint %s')
                            ->end()
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
                            ->isRequired()
                            ->values([Api::MODE_TEST, Api::MODE_PRODUCTION])
                        ->end()
                        ->enumNode('hash_mode')
                            ->defaultValue(Api::HASH_MODE_SHA256)
                            ->values([Api::HASH_MODE_SHA256, Api::HASH_MODE_SHA1])
                        ->end()
                        ->scalarNode('directory')
                            ->cannotBeEmpty()
                            ->defaultValue('%kernel.project_dir%/var/payzen')
                        ->end()
                        ->booleanNode('debug')
                            ->defaultValue('%kernel.debug%')
                        ->end()
                    ->end()
                ->end()
            ->end();
    }
}
