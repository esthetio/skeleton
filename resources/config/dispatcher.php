<?php

declare(strict_types=1);

use Esthete\Dispatcher\Attribute\CookieValue;
use Esthete\Dispatcher\Attribute\PathVariable;
use Esthete\Dispatcher\Attribute\RequestBody;
use Esthete\Dispatcher\Attribute\RequestFile;
use Esthete\Dispatcher\Attribute\RequestHeader;
use Esthete\Dispatcher\Attribute\RequestParam;
use Esthete\Dispatcher\AttributeHandlers\CookieValueAttributeHandler;
use Esthete\Dispatcher\AttributeHandlers\PathVariableAttributeHandler;
use Esthete\Dispatcher\AttributeHandlers\RequestBodyAttributeHandler;
use Esthete\Dispatcher\AttributeHandlers\RequestFileAttributeHandler;
use Esthete\Dispatcher\AttributeHandlers\RequestHeaderAttributeHandler;
use Esthete\Dispatcher\AttributeHandlers\RequestParamAttributeHandler;

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
