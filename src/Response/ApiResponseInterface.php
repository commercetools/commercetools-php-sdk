<?php
/**
 * @author @ct-jensschulze <jens.schulze@commercetools.de>
 * @created: 28.01.15, 10:07
 */
namespace Sphere\Core\Response;

use Psr\Http\Message\ResponseInterface;
use Sphere\Core\Client\Adapter\AdapterPromiseInterface;
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
     * @return ResponseInterface|AdapterPromiseInterface
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
     * @return ApiResponseInterface
     */
    public function then(callable $onFulfilled = null, callable $onRejected = null);

    /**
     * @param string $header
     * @return array
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
