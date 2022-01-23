<?php

declare(strict_types=1);

namespace App\Kernel\Http\Middleware;

use Esthetio\Dispatcher\Dispatcher;
use Esthetio\Http\Middleware\MiddlewareInterface;
use Esthetio\Http\Middleware\StackInterface;
use InvalidArgumentException;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\RequestContext;
use Symfony\Component\Routing\RouterInterface;

final class ExecuteController implements MiddlewareInterface
{
    /** @var \Symfony\Component\Routing\RouterInterface */
    private RouterInterface $router;

    /** @var \Esthetio\Dispatcher\Dispatcher */
    private Dispatcher $dispatcher;

    /**
     * @param  \Symfony\Component\Routing\RouterInterface  $router
     * @param  \Esthetio\Dispatcher\Dispatcher              $dispatcher
     */
    public function __construct(RouterInterface $router, Dispatcher $dispatcher)
    {
        $this->router     = $router;
        $this->dispatcher = $dispatcher;
    }

    public function process(Request $request, StackInterface $stack): Response
    {
        $this->router->setContext((new RequestContext())->fromRequest($request));

        $match = $this->router->match($request->getPathInfo());

        $request->attributes->add($match);

        [$controller, $method] = $this->extractController($match);

        return $this->dispatcher->dispatch($request, $controller, $method);
    }

    /**
     * @param  array  $match
     *
     * @return string[]
     */
    private function extractController(array $match): array
    {
        if (empty($match['_controller'])) {
            throw new InvalidArgumentException('Controller should be a non-empty string');
        }

        $fragments = explode('::', $match['_controller'], 2);

        if (count($fragments) < 2) {
            $fragments[] = '__invoke';
        }

        return $fragments;
    }
}
