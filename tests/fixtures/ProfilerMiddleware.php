<?php

namespace Commercetools\Core\Fixtures;

use Commercetools\Core\Helper\Uuid;
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
            $uuid = Uuid::uuidv4();
            $this->stopwatch->start($uuid);
            return $handler($request, $options)
                ->then(function (ResponseInterface $response) use ($uuid, $request) {
                    // After
                    $event = $this->stopwatch->stop($uuid);
                    $this->profiler->add($event, $request, $response);
                    return $response;
                }, function (GuzzleException $exception) use ($uuid, $request) {
                    $response = $exception instanceof RequestException ? $exception->getResponse() : null;
                    $event = $this->stopwatch->stop($uuid);
                    $this->profiler->add($event, $request, $response);
                    throw $exception;
                });
        };
    }
}
