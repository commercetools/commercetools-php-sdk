<?php
/**
 * @author @ct-jensschulze <jens.schulze@commercetools.de>
 * @created: 02.02.15, 11:26
 */

namespace Sphere\Core\Request\Products;


use Sphere\Core\Http\HttpMethod;
use Sphere\Core\Http\HttpRequest;
use Sphere\Core\Http\HttpRequestInterface;
use Sphere\Core\Request\AbstractApiRequest;
use Sphere\Core\Response\AbstractApiResponse;
use Sphere\Core\Response\PagedQueryResponse;

class ProductsSearchRequest extends AbstractApiRequest
{
    /**
     * @param $response
     * @return AbstractApiResponse
     */
    public function buildResponse($response)
    {
        return new PagedQueryResponse($response, $this);
    }

    /**
     * @return HttpRequestInterface
     */
    public function httpRequest()
    {
        return new HttpRequest(HttpMethod::GET, ProductProjectionEndpoint::endpoint());
    }

}
