<?php

namespace Commercetools\Core\Fixtures;

use Psr\Http\Message\RequestInterface;
use Psr\Http\Message\ResponseInterface;
use Symfony\Component\Stopwatch\StopwatchEvent;

class TimingProfiler implements Profiler
{
//    private $profiles = [];

    private $file;

    /**
     * TimingProfiler constructor.
     * @param $fileName
     */
    public function __construct($fileName)
    {
        $this->file = fopen($fileName, 'w');
        fputcsv(
            $this->file,
            [
                'method',
                'uri',
                'duration',
                'context',
                'correlationId',
                'serverTiming'
            ],
            ';',
            '"'
        );
    }

    /**
     * @inheritDoc
     */
    public function add(StopwatchEvent $stopwatchEvent, RequestInterface $request, ResponseInterface $response = null)
    {
//        $this->profiles[] = new Profile($stopwatchEvent, $request, $response);

        $context = [];
        if ($request->getMethod() == 'POST') {
            $body = json_decode($request->getBody());
            if (isset($body->actions)) {
                $context = array_map(
                    function ($action) {
                        return $action->action;
                    },
                    $body->actions
                );
            }
        }
        $correlationId = '';
        $serverTiming = '';
        if (!is_null($response)) {
            $correlationId = $response->getHeaderLine('x-correlation-id');
            $serverTiming = $response->getHeaderLine('server-timing');
        }
        fputcsv(
            $this->file,
            [
                $request->getMethod(),
                (string)$request->getUri(),
                $stopwatchEvent->getDuration(),
                implode(",", $context),
                $correlationId,
                $serverTiming
            ],
            ';',
            '"'
        );
    }
}
