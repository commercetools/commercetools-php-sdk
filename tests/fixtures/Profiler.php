<?php

namespace Commercetools\Core\Fixtures;

use Psr\Http\Message\RequestInterface;
use Psr\Http\Message\ResponseInterface;
use Symfony\Component\Stopwatch\StopwatchEvent;

interface Profiler
{
    /**
     * @param StopwatchEvent $stopwatchEvent
     * @param \Psr\Http\Message\RequestInterface $request
     * @param \Psr\Http\Message\ResponseInterface $response
     * @return
     */
    public function add(StopwatchEvent $stopwatchEvent, RequestInterface $request, ResponseInterface $response = null);
}
