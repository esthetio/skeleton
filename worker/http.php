<?php

declare(strict_types=1);

use App\Kernel\Http\Kernel;
use Nyholm\Psr7\Factory\Psr17Factory;
use Spiral\RoadRunner\Http\PSR7Worker;
use Spiral\RoadRunner\Worker;
use Symfony\Bridge\PsrHttpMessage\Factory\HttpFoundationFactory;
use Symfony\Bridge\PsrHttpMessage\Factory\PsrHttpFactory;

require __DIR__ . '/../vendor/autoload.php';

$psrFactory            = new Psr17Factory();
$httpFoundationFactory = new HttpFoundationFactory();
$psrHttpFactory        = new PsrHttpFactory($psrFactory, $psrFactory, $psrFactory, $psrFactory);
$psr7                  = new PSR7Worker(Worker::create(), $psrFactory, $psrFactory, $psrFactory);

/** @var \Psr\Container\ContainerInterface $container */
$container = require __DIR__ . '/../bootstrap/container.php';
$kernel    = $container->get(Kernel::class);

while (true) {
    try {
        $symfonyRequest  = $httpFoundationFactory->createRequest($psr7->waitRequest());
        $symfonyResponse = $kernel->process($symfonyRequest);

        $psr7->respond($psrHttpFactory->createResponse($symfonyResponse));

        $kernel->terminate($symfonyRequest, $symfonyResponse);
    } catch (Throwable $e) {
        $psr7->getWorker()->error($e->getMessage());
        $psr7->respond($psrFactory->createResponse(400));
    }
}
