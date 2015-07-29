<?php
/**
 * @author @ct-jensschulze <jens.schulze@commercetools.de>
 * @created: 21.01.15, 11:38
 */

namespace Sphere\Core\Request;

use Psr\Http\Message\RequestInterface;
use Psr\Http\Message\ResponseInterface;
use Sphere\Core\Model\Common\Context;
use Sphere\Core\Response\ApiResponseInterface;

/**
 * Interface ClientRequestInterface
 * @package Sphere\Core\Http
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
     * @return mixed
     */
    public function mapResult(array $result, Context $context = null);

    /**
     * @param ApiResponseInterface $response
     * @return mixed
     */
    public function mapResponse(ApiResponseInterface $response);
}
