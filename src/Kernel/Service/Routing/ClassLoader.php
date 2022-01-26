<?php

declare(strict_types=1);

namespace App\Kernel\Service\Routing;

use ReflectionClass;
use ReflectionMethod;
use Symfony\Component\Routing\Loader\AnnotationClassLoader;
use Symfony\Component\Routing\Route;

final class ClassLoader extends AnnotationClassLoader
{
    protected function configureRoute(
        Route $route,
        ReflectionClass $class,
        ReflectionMethod $method,
        object $annot
    ): void {
        $route->setDefault('_controller', sprintf('%s::%s', $class->getName(), $method->getName()));
    }
}
