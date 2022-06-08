<?php

declare(strict_types=1);

namespace Ekyna\Bundle\PayumPayzenBundle\Tests\DependencyInjection\Compiler;

use Ekyna\Bundle\PayumPayzenBundle\DependencyInjection\Compiler\RegisterGatewayPass;
use Ekyna\Component\Payum\Payzen\PayzenGatewayFactory;
use PHPUnit\Framework\MockObject\MockObject;
use PHPUnit\Framework\TestCase;
use Symfony\Component\DependencyInjection\ContainerBuilder;
use Symfony\Component\DependencyInjection\Definition;
use Symfony\Component\DependencyInjection\Parameter;

/**
 * Class RegisterGatewayPassTest
 * @package Ekyna\Bundle\PayumPayzenBundle\Tests\DependencyInjection\Compiler
 * @author  Étienne Dauvergne <contact@ekyna.com>
 */
class RegisterGatewayPassTest extends TestCase
{
    public function testProcess()
    {
        /** @var MockObject|ContainerBuilder $container */
        $container = $this->createMock(ContainerBuilder::class);

        /** @var MockObject|Definition $definition */
        $definition = $this->createMock(Definition::class);

        $container
            ->expects(self::once())
            ->method('hasDefinition')
            ->with('payum.builder')
            ->willReturn(true);

        $container
            ->expects(self::once())
            ->method('getDefinition')
            ->with('payum.builder')
            ->willReturn($definition);

        $definition
            ->expects(self::at(0))
            ->method('addMethodCall')
            ->with('addGatewayFactoryConfig', ['payzen', new Parameter('ekyna_payum_payzen.api_config')]);

        $definition
            ->expects(self::at(1))
            ->method('addMethodCall')
            ->with('addGatewayFactory', ['payzen', [PayzenGatewayFactory::class, 'build']]);

        $pass = new RegisterGatewayPass();
        $pass->process($container);
    }
}
