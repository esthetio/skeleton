<?php

declare(strict_types=1);

namespace App\Kernel\Providers;

use DI\ContainerBuilder;
use Esthete\Cookie\CookieJar;
use Esthete\Cookie\CookieJarImpl;

final class CookieServiceProvider
{
    public function __invoke(ContainerBuilder $builder): void
    {
        $builder->addDefinitions(
            [
                CookieJar::class => fn() => new CookieJarImpl(),
            ]
        );
    }
}
