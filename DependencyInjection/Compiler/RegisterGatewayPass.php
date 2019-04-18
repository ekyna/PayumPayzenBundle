<?php

namespace Ekyna\Bundle\PayumPayzenBundle\DependencyInjection\Compiler;

use Ekyna\Component\Payum\Payzen\PayzenGatewayFactory;
use Symfony\Component\DependencyInjection\Compiler\CompilerPassInterface;
use Symfony\Component\DependencyInjection\ContainerBuilder;
use Symfony\Component\DependencyInjection\Parameter;

/**
 * Class RegisterGatewayPass
 * @package Ekyna\Bundle\PayumPayzenBundle\DependencyInjection\Compiler
 * @author  Etienne Dauvergne <contact@ekyna.com>
 */
class RegisterGatewayPass implements CompilerPassInterface
{
    /**
     * @inheritdoc
     */
    public function process(ContainerBuilder $container)
    {
        if (!$container->hasDefinition('payum.builder')) {
            return;
        }

        $builder = $container->getDefinition('payum.builder');

        $builder->addMethodCall(
            'addGatewayFactoryConfig',
            ['payzen', new Parameter('ekyna_payum_payzen.api_config')]
        );

        $builder->addMethodCall(
            'addGatewayFactory',
            ['payzen', [PayzenGatewayFactory::class, 'build']]
        );
    }
}
