<?php

declare(strict_types=1);

namespace App\Kernel\Providers;

use DI\ContainerBuilder;
use Esthete\Config\Config;
use Esthete\Dispatcher\ArgumentResolver;
use Esthete\Dispatcher\ControllerFactory;
use Esthete\Dispatcher\Dispatcher;
use Esthete\Dispatcher\DispatcherImpl;
use Esthete\Dispatcher\Invoker;
use Esthete\Dispatcher\ResponseFactory;
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
