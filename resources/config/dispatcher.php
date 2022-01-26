<?php

declare(strict_types=1);

use Esthetio\Dispatcher\Attribute\CookieValue;
use Esthetio\Dispatcher\Attribute\PathVariable;
use Esthetio\Dispatcher\Attribute\RequestBody;
use Esthetio\Dispatcher\Attribute\RequestFile;
use Esthetio\Dispatcher\Attribute\RequestHeader;
use Esthetio\Dispatcher\Attribute\RequestParam;
use Esthetio\Dispatcher\AttributeHandlers\CookieValueAttributeHandler;
use Esthetio\Dispatcher\AttributeHandlers\PathVariableAttributeHandler;
use Esthetio\Dispatcher\AttributeHandlers\RequestBodyAttributeHandler;
use Esthetio\Dispatcher\AttributeHandlers\RequestFileAttributeHandler;
use Esthetio\Dispatcher\AttributeHandlers\RequestHeaderAttributeHandler;
use Esthetio\Dispatcher\AttributeHandlers\RequestParamAttributeHandler;

return [
    'dispatcher' => [
        'handlers' => [
            CookieValue::class   => CookieValueAttributeHandler::class,
            PathVariable::class  => PathVariableAttributeHandler::class,
            RequestBody::class   => RequestBodyAttributeHandler::class,
            RequestFile::class   => RequestFileAttributeHandler::class,
            RequestHeader::class => RequestHeaderAttributeHandler::class,
            RequestParam::class  => RequestParamAttributeHandler::class,
        ],
    ],
];
