<?php

namespace Ekyna\Bundle\PayumPayzenBundle;

use Ekyna\Bundle\PayumPayzenBundle\DependencyInjection\Compiler\RegisterGatewayPass;
use Symfony\Component\DependencyInjection\ContainerBuilder;
use Symfony\Component\HttpKernel\Bundle\Bundle;

/**
 * Class EkynaPayumPayzenBundle
 * @package Ekyna\Bundle\PayumPayzenBundle
 * @author  Etienne Dauvergne <contact@ekyna.com>
 */
class EkynaPayumPayzenBundle extends Bundle
{
    /**
     * @inheritdoc
     */
    public function build(ContainerBuilder $container)
    {
        parent::build($container);

        $container->addCompilerPass(new RegisterGatewayPass());
    }
}
