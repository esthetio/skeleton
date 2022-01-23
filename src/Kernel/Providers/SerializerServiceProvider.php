<?php

declare(strict_types=1);

namespace App\Kernel\Providers;

use DI\ContainerBuilder;
use Symfony\Component\Serializer\Encoder\JsonEncoder;
use Symfony\Component\Serializer\Encoder\XmlEncoder;
use Symfony\Component\Serializer\Normalizer\ObjectNormalizer;
use Symfony\Component\Serializer\Serializer;
use Symfony\Component\Serializer\SerializerInterface;

final class SerializerServiceProvider
{
    /**
     * @param  \DI\ContainerBuilder  $builder
     */
    public function __invoke(ContainerBuilder $builder): void
    {
        $builder->addDefinitions(
            [
                SerializerInterface::class => fn() => new Serializer(
                    [new ObjectNormalizer()],
                    [new JsonEncoder(), new XmlEncoder()]
                ),
            ]
        );
    }
}
