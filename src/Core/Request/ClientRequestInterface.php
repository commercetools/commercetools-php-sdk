<?php
/**
 * @author @jenschude <jens.schulze@commercetools.de>
 * @created: 21.01.15, 11:38
 */

namespace Commercetools\Core\Request;

use Commercetools\Core\Model\MapperInterface;
use Psr\Http\Message\RequestInterface;
use Psr\Http\Message\ResponseInterface;
use Commercetools\Core\Model\Common\Context;
use Commercetools\Core\Response\ApiResponseInterface;

/**
 * Interface ClientRequestInterface
 * @package Commercetools\Core\Http
 */
interface ClientRequestInterface
{
    /**
     * @return string
     */
    public function getIdentifier();

    /**
     * @param string $identifier
     * @return $this
     */
    public function setIdentifier($identifier);

    /**
     * @return RequestInterface
     * @internal
     */
    public function httpRequest();

    /**
     * @param ResponseInterface $response
     * @return ApiResponseInterface
     * @internal
     */
    public function buildResponse(ResponseInterface $response);

    /**
     * @param array $result
     * @param Context $context
     * @return mixed
     */
    public function mapResult(array $result, Context $context = null);

    /**
     * @param ApiResponseInterface $response
     * @return mixed
     */
    public function mapResponse(ApiResponseInterface $response);

    /**
     * @param array $data
     * @param Context $context
     * @param MapperInterface $mapper
     * @return mixed
     */
    public function map(array $data, Context $context = null, MapperInterface $mapper = null);

    /**
     * @param ApiResponseInterface $response
     * @param MapperInterface $mapper
     * @return mixed
     */
    public function mapFromResponse(ApiResponseInterface $response, MapperInterface $mapper = null);
}
