<?php

declare(strict_types=1);

namespace App\Kernel\Providers;

use DI\ContainerBuilder;
use Esthete\Config\Config;
use Psr\Container\ContainerInterface;
use Symfony\Component\Config\FileLocator;
use Symfony\Component\Routing\Loader\YamlFileLoader;
use Symfony\Component\Routing\Router;
use Symfony\Component\Routing\RouterInterface;

final class RoutingServiceProvider
{
    /**
     * @param  \DI\ContainerBuilder  $builder
     */
    public function __invoke(ContainerBuilder $builder): void
    {
        $builder->addDefinitions(
            [
                RouterInterface::class => function (ContainerInterface $container) {
                    $locator = new FileLocator([__DIR__ . '/../../../resources']);
                    $config  = $container->get(Config::class);

                    return new Router(
                        new YamlFileLoader($locator),
                        'routing.yaml',
                        [
                            'cache_dir' => __DIR__ . '/../../../var/cache/router',
                            'debug'     => $config->get('debug', false),
                        ]
                    );
                },
            ]
        );
    }
}
