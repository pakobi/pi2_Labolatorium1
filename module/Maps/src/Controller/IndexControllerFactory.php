<?php

namespace Maps\Controller;

use Maps\Model\Geopoint;
use Psr\Container\ContainerInterface;
use Laminas\ServiceManager\Factory\FactoryInterface;

class IndexControllerFactory implements FactoryInterface
{
    public function __invoke(ContainerInterface $container, $requestedName, array $options = null)
    {
        $Geopoint = $container->get(Geopoint::class);
        return new IndexController($Geopoint);
    }
}