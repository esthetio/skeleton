<?php

declare(strict_types=1);

namespace App\Kernel\Http;

use App\Kernel\Http\Middleware\AddCookiesToResponse;
use App\Kernel\Http\Middleware\ExecuteController;
use Esthetio\Http\AbstractKernel;
use Psr\Container\ContainerInterface;

class Kernel extends AbstractKernel
{
    protected function getPipeline(ContainerInterface $container): array
    {
        return [
            $container->get(AddCookiesToResponse::class),
            $container->get(ExecuteController::class),
        ];
    }
}
