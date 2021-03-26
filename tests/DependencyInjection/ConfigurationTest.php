<?php

declare(strict_types=1);

namespace Ekyna\Bundle\PayumPayzenBundle\Tests\DependencyInjection;

use Ekyna\Bundle\PayumPayzenBundle\DependencyInjection\Configuration;
use Ekyna\Component\Payum\Payzen\Api\Api;
use Generator;
use PHPUnit\Framework\TestCase;
use Symfony\Component\Config\Definition\Exception\Exception;
use Symfony\Component\Config\Definition\Processor;

/**
 * Class ConfigurationTest
 * @package Ekyna\Bundle\PayumPayzenBundle\Tests\DependencyInjection
 * @author  Étienne Dauvergne <contact@ekyna.com>
 */
class ConfigurationTest extends TestCase
{
    /**
     * @var Configuration
     */
    private $configuration;

    /**
     * @var Processor
     */
    private $processor;

    protected function setUp(): void
    {
        $this->configuration = new Configuration();
        $this->processor = new Processor();
    }

    protected function tearDown(): void
    {
        $this->configuration = null;
        $this->processor = null;
    }

    /**
     * @param array $config
     *
     * @dataProvider provideValidConfigs
     */
    public function testValidApiConfig(array $config): void
    {
        $this->processor->processConfiguration($this->configuration, [
            'ekyna_payum_payen' => [
                'api' => $config,
            ],
        ]);

        $this->assertTrue(true);
    }

    /**
     * @param array $config
     *
     * @dataProvider provideInvalidConfigs
     */
    public function testInvalidApiConfig(array $config): void
    {
        $this->expectException(Exception::class);

        $this->processor->processConfiguration($this->configuration, [
            'ekyna_payum_payzen' => [
                'api' => $config,
            ],
        ]);
    }

    public function provideValidConfigs(): Generator
    {
        yield [
            [
                'ctx_mode'    => Api::MODE_PRODUCTION,
                'site_id'     => '1324567890',
                'certificate' => '1234567890',
                'endpoint'    => Api::ENDPOINT_SYSTEMPAY,
                'hash_mode'   => Api::HASH_MODE_SHA256,
                'directory'   => '%kernel.project_dir%/var/payzen',
                'debug'       => true,
            ],
        ];

        yield [
            [
                'ctx_mode'    => Api::MODE_PRODUCTION,
                'site_id'     => '1324567890',
                'certificate' => '1234567890',
            ],
        ];
    }

    public function provideInvalidConfigs(): Generator
    {
        yield [
            [
                'site_id'     => '1324567890',
                'certificate' => '1234567890',
            ],
        ];

        yield [
            [
                'ctx_mode'    => Api::MODE_PRODUCTION,
                'certificate' => '1234567890',
            ],
        ];

        yield [
            [
                'ctx_mode'    => 'foo',
                'site_id'     => '1324567890',
                'certificate' => '1234567890',
            ],
        ];

        yield [
            [
                'ctx_mode'    => Api::MODE_PRODUCTION,
                'site_id'     => '1324567890',
                'certificate' => '1234567890',
                'endpoint'    => 'foo',
            ],
        ];

        yield [
            [
                'ctx_mode'    => Api::MODE_PRODUCTION,
                'site_id'     => '1324567890',
                'certificate' => '1234567890',
                'hash_mode'   => 'foo',
            ],
        ];
    }
}
