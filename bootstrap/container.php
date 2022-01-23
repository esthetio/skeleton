<?php

declare(strict_types=1);

use DI\ContainerBuilder;
use M1\Env\Parser;

$_ENV = array_merge($_ENV, Parser::parse(file_get_contents(__DIR__ . '/../.env')));

$builder = new ContainerBuilder();

foreach (require __DIR__ . '/services.php' as $provider) {
    (new $provider())($builder);
}

$builder->addDefinitions(['config' => include __DIR__ . '/config.php']);

return $builder->build();
