<?php

declare(strict_types=1);

namespace Ekyna\Bundle\PayumPayzenBundle\Tests\Functional\App;

use Ekyna\Bundle\PayumPayzenBundle\EkynaPayumPayzenBundle;
use Payum\Bundle\PayumBundle\PayumBundle;
use Symfony\Bundle\FrameworkBundle\FrameworkBundle;
use Symfony\Bundle\TwigBundle\TwigBundle;
use Symfony\Component\Config\Loader\LoaderInterface;
use Symfony\Component\HttpKernel\Kernel;

use function sys_get_temp_dir;

/**
 * Class AppKernel
 * @package Ekyna\Bundle\PayumPayzenBundle\Tests\Functionnal\App
 * @author  Étienne Dauvergne <contact@ekyna.com>
 */
class AppKernel extends Kernel
{
    public function registerBundles()
    {
        return [
            new FrameworkBundle(),
            new TwigBundle(),
            new PayumBundle(),
            new EkynaPayumPayzenBundle(),
        ];
    }

    public function registerContainerConfiguration(LoaderInterface $loader)
    {
        $loader->load(__DIR__.'/config.yml');
    }

    public function getProjectDir()
    {
        return __DIR__;
    }

    public function getCacheDir()
    {
        return sys_get_temp_dir().'/EkynaPayumPazen/cache/'.$this->environment;
    }

    public function getLogDir()
    {
        return sys_get_temp_dir().'/EkynaPayumPazen/logs';
    }
}
