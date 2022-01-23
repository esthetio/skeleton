<?php

declare(strict_types=1);

namespace App\Kernel\Http\Middleware;

use Esthete\Cookie\CookieJar;
use Esthete\Http\Middleware\MiddlewareInterface;
use Esthete\Http\Middleware\StackInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

final class AddCookiesToResponse implements MiddlewareInterface
{
    /** @var \Esthete\Cookie\CookieJar */
    private CookieJar $cookieJar;

    /**
     * @param  \Esthete\Cookie\CookieJar  $cookie
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
