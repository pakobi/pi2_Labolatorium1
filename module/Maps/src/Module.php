<?php

namespace Maps;

use Interop\Container\ContainerInterface;
use Laminas\Db\Adapter\AdapterAwareInterface;
use Laminas\Db\Adapter\AdapterInterface;

class Module
{
    public function getConfig()
    {
        return include __DIR__ . '/../config/module.config.php';
    }

    public function getServiceConfig(): array
    {
        return [
            'initializers' => [
                'db' => function (ContainerInterface $container, $instance) {
                    if ($instance instanceof AdapterAwareInterface) {
                        $instance->setDbAdapter($container->get(AdapterInterface::class));
                    }
                },
            ],
        ];
    }
}
