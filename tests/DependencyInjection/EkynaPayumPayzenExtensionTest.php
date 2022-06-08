<?php

declare(strict_types=1);

namespace Ekyna\Bundle\PayumPayzenBundle\Tests\DependencyInjection;

use Ekyna\Bundle\PayumPayzenBundle\DependencyInjection\EkynaPayumPayzenExtension;
use Ekyna\Component\Payum\Payzen\Api\Api;
use PHPUnit\Framework\MockObject\MockObject;
use PHPUnit\Framework\TestCase;
use Symfony\Component\DependencyInjection\ContainerBuilder;

/**
 * Class EkynaPayumPayzenExtensionTest
 * @package Ekyna\Bundle\PayumPayzenBundle\Tests\DependencyInjection
 * @author  Étienne Dauvergne <contact@ekyna.com>
 */
class EkynaPayumPayzenExtensionTest extends TestCase
{
    public function testSetApiConfigAsContainerParameter(): void
    {
        $config = [
            'ctx_mode'    => Api::MODE_PRODUCTION,
            'site_id'     => '1324567890',
            'certificate' => '1234567890',
            'endpoint'    => null,
        ];

        $expected = [
            'ctx_mode'    => Api::MODE_PRODUCTION,
            'site_id'     => '1324567890',
            'certificate' => '1234567890',
            'endpoint'    => null,
            'hash_mode'   => Api::HASH_MODE_SHA256,
            'directory'   => '%kernel.project_dir%/var/payzen',
            'debug'       => '%kernel.debug%',
        ];

        /** @var MockObject|ContainerBuilder $container */
        $container = $this->createMock(ContainerBuilder::class);
        $container
            ->expects(self::once())
            ->method('setParameter')
            ->with('ekyna_payum_payzen.api_config', $expected);

        $extension = new EkynaPayumPayzenExtension();
        $extension->load([
            'ekyna_payum_payzen' => [
                'api' => $config,
            ],
        ], $container);
    }
}
