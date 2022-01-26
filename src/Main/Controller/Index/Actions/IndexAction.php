<?php

declare(strict_types=1);

namespace App\Main\Controller\Index\Actions;

use Esthetio\Dispatcher\Attribute\RequestParam;
use Symfony\Component\Routing\Annotation\Route;

#[Route('/', 'index_')]
final class IndexAction
{
    /**
     * @param  string|null  $quote
     *
     * @return string
     */
    #[Route('/', 'index')]
    public function __invoke(#[RequestParam] ?string $quote): string
    {
        return $quote ?? 'Hello world';
    }
}
