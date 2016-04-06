<?php
/**
 * @author @jayS-de <jens.schulze@commercetools.de>
 * @created: 28.01.15, 10:07
 */
namespace Commercetools\Core\Response;

use Commercetools\Core\Error\ErrorContainer;
use Psr\Http\Message\ResponseInterface;
use Commercetools\Core\Client\Adapter\AdapterPromiseInterface;
use Commercetools\Core\Request\ClientRequestInterface;

/**
 * Interface ApiResponseInterface
 * @package Commercetools\Core\Http
 */
interface ApiResponseInterface
{
    public function toObject();

    /**
     * @return array
     */
    public function toArray();

    /**
     * @return string
     */
    public function getBody();

    /**
     * @return bool
     */
    public function isError();

    /**
     * @return ErrorContainer
     */
    public function getErrors();

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

    /**
     * @return string
     */
    public function getCorrelationId();
}
