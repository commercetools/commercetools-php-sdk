<?php
/**
 * @author @ct-jensschulze <jens.schulze@commercetools.de>
 * @created: 28.01.15, 10:07
 */
namespace Sphere\Core\Response;

use GuzzleHttp\Message\ResponseInterface;
use GuzzleHttp\Ring\Future\FutureInterface;
use React\Promise\PromiseInterface;
use Sphere\Core\Request\ClientRequestInterface;

/**
 * Interface ApiResponseInterface
 * @package Sphere\Core\Http
 */
interface ApiResponseInterface
{
    public function toObject();

    public function toArray();

    public function getBody();

    public function isError();

    /**
     * @return ResponseInterface|FutureInterface
     */
    public function getResponse();

    /**
     * @return ClientRequestInterface
     */
    public function getRequest();

    /**
     * @return mixed
     */
    public function wait();

    /**
     * @param callable $onFulfilled
     * @param callable $onRejected
     * @param callable $onProgress
     * @return PromiseInterface
     */
    public function then(callable $onFulfilled = null, callable $onRejected = null, callable $onProgress = null);

    public function cancel();

    /**
     * @param string $header
     * @return string
     */
    public function getHeader($header);

    /**
     * @return array
     */
    public function getHeaders();

    /**
     * @return int
     */
    public function getStatusCode();
}
