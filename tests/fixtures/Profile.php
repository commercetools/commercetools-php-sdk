<?php

namespace Commercetools\Core\Fixtures;

use Psr\Http\Message\RequestInterface;
use Psr\Http\Message\ResponseInterface;
use Symfony\Component\Stopwatch\StopwatchEvent;

class Profile
{
    /**
     * @var StopwatchEvent
     */
    private $stopwatchEvent;

    /**
     * @var RequestInterface
     */
    private $request;

    /**
     * @var ResponseInterface
     */
    private $response;

    /**
     * Profile constructor.
     * @param StopwatchEvent $stopwatchEvent
     * @param RequestInterface $request
     * @param ResponseInterface $response
     */
    public function __construct(
        StopwatchEvent $stopwatchEvent,
        RequestInterface $request,
        ResponseInterface $response = null
    ) {
        $this->stopwatchEvent = $stopwatchEvent;
        $this->request = $request;
        $this->response = $response;
    }

    /**
     * @return StopwatchEvent
     */
    public function getStopwatchEvent()
    {
        return $this->stopwatchEvent;
    }

    /**
     * @return RequestInterface
     */
    public function getRequest()
    {
        return $this->request;
    }

    /**
     * @return ResponseInterface
     */
    public function getResponse()
    {
        return $this->response;
    }
}
