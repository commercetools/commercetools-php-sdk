<?php
/**
 * @author @ct-jensschulze <jens.schulze@commercetools.de>
 * @created: 21.01.15, 11:38
 */

namespace Sphere\Core\Request;

use Sphere\Core\Client\HttpRequestInterface;
use Sphere\Core\Response\ApiResponseInterface;

/**
 * Interface ClientRequestInterface
 * @package Sphere\Core\Http
 */
interface ClientRequestInterface
{
    /**
     * @return HttpRequestInterface
     * @internal
     */
    public function httpRequest();

    /**
     * @param $response
     * @return ApiResponseInterface
     * @internal
     */
    public function buildResponse($response);
}
