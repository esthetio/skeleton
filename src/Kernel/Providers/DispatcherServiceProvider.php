<?php

declare(strict_types=1);

namespace App\Kernel\Providers;

use DI\ContainerBuilder;
use Esthetio\Config\Config;
use Esthetio\Dispatcher\ArgumentResolver;
use Esthetio\Dispatcher\ControllerFactory;
use Esthetio\Dispatcher\Dispatcher;
use Esthetio\Dispatcher\DispatcherImpl;
use Esthetio\Dispatcher\Invoker;
use Esthetio\Dispatcher\ResponseFactory;
use Psr\Container\ContainerInterface;
use Symfony\Component\Serializer\SerializerInterface;

final class DispatcherServiceProvider
{
    /**
     * @param  \DI\ContainerBuilder  $builder
     */
    public function __invoke(ContainerBuilder $builder): void
    {
        $builder->addDefinitions(
            [
                Dispatcher::class => function (ContainerInterface $container) {
                    $argumentResolver = new ArgumentResolver();
                    $handlers         = $container->get(Config::class)->get('dispatcher.handlers', []);

                    foreach ($handlers as $attribute => $handler) {
                        $argumentResolver->addHandler($attribute, $container->get($handler));
                    }

                    return new DispatcherImpl(
                        new ControllerFactory($container),
                        new ResponseFactory($container->get(SerializerInterface::class)),
                        new Invoker($argumentResolver)
                    );
                },
            ]
        );
    }
}
