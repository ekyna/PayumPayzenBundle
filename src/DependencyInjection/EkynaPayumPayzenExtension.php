<?php

namespace Ekyna\Bundle\PayumPayzenBundle\DependencyInjection;

use Symfony\Component\DependencyInjection\ContainerBuilder;
use Symfony\Component\HttpKernel\DependencyInjection\Extension;

/**
 * Class EkynaPayumPayzenExtension
 * @package Ekyna\Bundle\PayumPayzenBundle\DependencyInjection
 * @author  Etienne Dauvergne <contact@ekyna.com>
 */
class EkynaPayumPayzenExtension extends Extension
{
    /**
     * @inheritdoc
     */
    public function load(array $configs, ContainerBuilder $container)
    {
        $configuration = new Configuration();
        $config = $this->processConfiguration($configuration, $configs);

        // Api Config
        $container->setParameter('ekyna_payum_payzen.api_config', $config['api']);
    }
}
