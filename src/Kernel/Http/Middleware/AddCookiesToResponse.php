<?php

declare(strict_types=1);

namespace App\Kernel\Http\Middleware;

use Esthetio\Cookie\CookieJar;
use Esthetio\Http\Middleware\MiddlewareInterface;
use Esthetio\Http\Middleware\StackInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

final class AddCookiesToResponse implements MiddlewareInterface
{
    /** @var \Esthetio\Cookie\CookieJar */
    private CookieJar $cookieJar;

    /**
     * @param  \Esthetio\Cookie\CookieJar  $cookie
     */
    public function __construct(CookieJar $cookie)
    {
        $this->cookieJar = $cookie;
    }

    public function process(Request $request, StackInterface $stack): Response
    {
        $response = $stack->next()->process($request, $stack);

        foreach ($this->cookieJar->flush() as $cookie) {
            $response->headers->setCookie($cookie);
        }

        return $response;
    }
}
