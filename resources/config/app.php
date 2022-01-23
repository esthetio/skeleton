<?php

declare(strict_types=1);

use Laminas\ConfigAggregator\ConfigAggregator;

return [
    ConfigAggregator::ENABLE_CACHE => ! $_ENV['APP_DEBUG'],
    'debug'                        => $_ENV['APP_DEBUG'],
];
