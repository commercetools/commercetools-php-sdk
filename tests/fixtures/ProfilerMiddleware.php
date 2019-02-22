<?php

namespace Commercetools\Core\Fixtures;

use GuzzleHttp\Exception\GuzzleException;
use GuzzleHttp\Exception\RequestException;
use Psr\Http\Message\RequestInterface;
use Psr\Http\Message\ResponseInterface;
use Symfony\Component\Stopwatch\Stopwatch;

class ProfilerMiddleware
{
    /**
     * @var Profiler
     */
    private $profiler;

    /**
     * @var Stopwatch
     */
    private $stopwatch;

    /**
     *
     * @param Profiler $profiler
     * @param Stopwatch $stopwatch
     */
    public function __construct(Profiler $profiler, Stopwatch $stopwatch)
    {
        $this->profiler = $profiler;
        $this->stopwatch = $stopwatch;
    }
    /**
     * @param callable $handler
     *
     * @return callable
     */
    public function __invoke(callable $handler)
    {
        return function (RequestInterface $request, array $options) use ($handler) {
            // Set starting time.
            $name = $request->getMethod() . ' ' . (string)$request->getUri();
            $this->stopwatch->start($name);
            return $handler($request, $options)
                ->then(function (ResponseInterface $response) use ($name, $request) {
                    // After
                    $event = $this->stopwatch->stop($name);
                    $this->profiler->add($event, $request, $response);
                    return $response;
                }, function (GuzzleException $exception) use ($name, $request) {
                    $response = $exception instanceof RequestException ? $exception->getResponse() : null;
                    $event = $this->stopwatch->stop($name);
                    $this->profiler->add($event, $request, $response);
                    throw $exception;
                });
        };
    }
}
