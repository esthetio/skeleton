<?php

declare(strict_types=1);

namespace App\Web\Controller\Index\Actions;

use Esthete\Dispatcher\Attribute\RequestParam;

final class IndexAction
{
    /**
     * @param  string|null  $quote
     *
     * @return string
     */
    public function __invoke(#[RequestParam] ?string $quote): string
    {
        return $quote ?? 'Hello world';
    }
}
