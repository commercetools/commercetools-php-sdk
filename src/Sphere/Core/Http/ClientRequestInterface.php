<?php
/**
 * @author @ct-jensschulze <jens.schulze@commercetools.de>
 * @created: 21.01.15, 11:38
 */

namespace Sphere\Core\Http;


interface ClientRequestInterface
{
    /**
     * @return HttpRequestInterface
     */
    public function httpRequest();

    /**
     * @param $response
     * @return ApiResponseInterface
     */
    public function buildResponse($response);
}
