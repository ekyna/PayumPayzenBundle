<?php

declare(strict_types=1);

namespace Ekyna\Bundle\PayumPayzenBundle\Tests\Functional;

use Payum\Core\GatewayInterface;
use Symfony\Bundle\FrameworkBundle\Test\KernelTestCase;

/**
 * Class GatewayTest
 * @package Ekyna\Bundle\PayumPayzenBundle
 * @author  Étienne Dauvergne <contact@ekyna.com>
 */
class GatewayTest extends KernelTestCase
{
    public function testGatewayIsAvailable()
    {
        $container = static::bootKernel()->getContainer();

        /** @var \Payum\Core\Payum $payum */
        $payum = $container->get('payum');

        $gateway = $payum->getGateway('payzen');

        $this->assertInstanceOf(GatewayInterface::class, $gateway);
    }
}
