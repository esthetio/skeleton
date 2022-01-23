<?php

use Laminas\ConfigAggregator\ConfigAggregator;
use Laminas\ConfigAggregator\PhpFileProvider;

$aggregator = new ConfigAggregator(
    [new PhpFileProvider(__DIR__ . '/../resources/config/*.php')],
    __DIR__ . '/../var/cache/config.php'
);

return $aggregator->getMergedConfig();
