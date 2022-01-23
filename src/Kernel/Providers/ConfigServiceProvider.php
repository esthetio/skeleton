<?php

declare(strict_types=1);

namespace App\Kernel\Providers;

use DI\ContainerBuilder;
use Esthete\Config\Config;
use Esthete\Config\ConfigImpl;
use Psr\Container\ContainerInterface;

final class ConfigServiceProvider
{
    public function __invoke(ContainerBuilder $builder): void
    {
        $builder->addDefinitions(
            [
                Config::class => fn(ContainerInterface $container) => new ConfigImpl($container->get('config')),
            ]
        );
    }
}
