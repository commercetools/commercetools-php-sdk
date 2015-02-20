<?php
/**
 * @author @ct-jensschulze <jens.schulze@commercetools.de>
 * @created: 21.01.15, 11:38
 */

namespace Sphere\Core\Request;

use GuzzleHttp\Message\ResponseInterface;
use Sphere\Core\Client\HttpRequestInterface;
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
     * @return HttpRequestInterface
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
    public function mapResult(array $result);
}
