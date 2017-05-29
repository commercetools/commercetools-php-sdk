<?php
/**
 * Origin: https://github.com/guzzle/log-subscriber
 * Copyright (c) 2014 Michael Dowling, https://github.com/mtdowling <mtdowling@gmail.com>
 *
 * Permission is hereby granted, free of charge, to any person obtaining a copy
 * of this software and associated documentation files (the "Software"), to deal
 * in the Software without restriction, including without limitation the rights
 * to use, copy, modify, merge, publish, distribute, sublicense, and/or sell
 * copies of the Software, and to permit persons to whom the Software is
 * furnished to do so, subject to the following conditions:
 *
 * The above copyright notice and this permission notice shall be included in
 * all copies or substantial portions of the Software.
 *
 * THE SOFTWARE IS PROVIDED "AS IS", WITHOUT WARRANTY OF ANY KIND, EXPRESS OR
 * IMPLIED, INCLUDING BUT NOT LIMITED TO THE WARRANTIES OF MERCHANTABILITY,
 * FITNESS FOR A PARTICULAR PURPOSE AND NONINFRINGEMENT. IN NO EVENT SHALL THE
 * AUTHORS OR COPYRIGHT HOLDERS BE LIABLE FOR ANY CLAIM, DAMAGES OR OTHER
 * LIABILITY, WHETHER IN AN ACTION OF CONTRACT, TORT OR OTHERWISE, ARISING FROM,
 * OUT OF OR IN CONNECTION WITH THE SOFTWARE OR THE USE OR OTHER DEALINGS IN
 * THE SOFTWARE.
 */
namespace Commercetools\Core\Helper\Subscriber\Log;

use GuzzleHttp\Event\RequestEvents;
use GuzzleHttp\Event\SubscriberInterface;
use GuzzleHttp\Event\CompleteEvent;
use GuzzleHttp\Event\ErrorEvent;
use Psr\Log\LoggerInterface;
use Psr\Log\LogLevel;

/**
 * Plugin class that will add request and response logging to an HTTP request.
 *
 * The log plugin uses a message formatter that allows custom messages via
 * template variable substitution.
 *
 * @see MessageLogger for a list of available template variable substitutions
 */
class LogSubscriber implements SubscriberInterface
{
    /** @var LoggerInterface */
    private $logger;

    /** @var Formatter Formatter used to format log messages */
    private $formatter;

    /**
     * @var string
     */
    private $logLevel;

    /**
     * @param LoggerInterface|callable|resource|null $logger Logger used to log
     *     messages. Pass a LoggerInterface to use a PSR-3 logger. Pass a
     *     callable to log messages to a function that accepts a string of
     *     data. Pass a resource returned from ``fopen()`` to log to an open
     *     resource. Pass null or leave empty to write log messages using
     *     ``echo()``.
     * @param string|Formatter $formatter Formatter used to format log
     *     messages or a string representing a message formatter template.
     */
    public function __construct($logger = null, $formatter = null, $logLevel = LogLevel::INFO)
    {
        $this->logLevel = $logLevel;
        $this->logger = $logger instanceof LoggerInterface
            ? $logger
            : new SimpleLogger($logger);

        $this->formatter = $formatter instanceof Formatter
            ? $formatter
            : new Formatter($formatter);
    }

    public function getEvents()
    {
        return [
            // Fire after responses are verified (which trigger error events).
            'complete' => ['onComplete', RequestEvents::VERIFY_RESPONSE - 10],
            'error'    => ['onError', RequestEvents::EARLY]
        ];
    }

    public function onComplete(CompleteEvent $event)
    {
        $this->logger->log(
            substr($event->getResponse()->getStatusCode(), 0, 1) == '2'
                ? $this->logLevel
                : LogLevel::WARNING,
            $this->formatter->format(
                $event->getRequest(),
                $event->getResponse()
            ),
            [
                'request' => $event->getRequest(),
                'response' => $event->getResponse()
            ]
        );
    }

    public function onError(ErrorEvent $event)
    {
        $ex = $event->getException();
        $this->logger->log(
            LogLevel::CRITICAL,
            $this->formatter->format(
                $event->getRequest(),
                $event->getResponse(),
                $ex
            ),
            [
                'request' => $event->getRequest(),
                'response' => $event->getResponse(),
                'exception' => $ex
            ]
        );
    }
}
