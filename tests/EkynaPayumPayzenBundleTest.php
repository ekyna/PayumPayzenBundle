<?php

declare(strict_types=1);

namespace Ekyna\Bundle\PayumPayzenBundle\Tests;

use Ekyna\Bundle\PayumPayzenBundle\DependencyInjection\Compiler\RegisterGatewayPass;
use Ekyna\Bundle\PayumPayzenBundle\EkynaPayumPayzenBundle;
use PHPUnit\Framework\MockObject\MockObject;
use PHPUnit\Framework\TestCase;
use Symfony\Component\DependencyInjection\ContainerBuilder;

/**
 * Class EkynaPayumPayzenBundleTest
 * @package Ekyna\Bundle\PayumPayzenBundle\Tests
 * @author  Étienne Dauvergne <contact@ekyna.com>
 */
class EkynaPayumPayzenBundleTest extends TestCase
{
    public function testRegisterGatewayPassToContainerBuilder()
    {
        /** @var MockObject|ContainerBuilder $container */
        $container = $this->createMock(ContainerBuilder::class);

        $container
            ->expects($this->at(0))
            ->method('addCompilerPass')
            ->with($this->isInstanceOf(RegisterGatewayPass::class));

        $bundle = new EkynaPayumPayzenBundle();
        $bundle->build($container);
    }
}
