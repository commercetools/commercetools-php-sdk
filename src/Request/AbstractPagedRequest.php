<?php
/**
 * @author @ct-jensschulze <jens.schulze@commercetools.de>
 * @created: 02.02.15, 15:35
 */

namespace Sphere\Core\Request;


use Sphere\Core\Http\HttpMethod;
use Sphere\Core\Http\HttpRequest;
use Sphere\Core\Response\PagedQueryResponse;

/**
 * Class AbstractPagedRequest
 * @package Sphere\Core\Request
 */
abstract class AbstractPagedRequest extends AbstractApiRequest
{
    use PageTrait;
    use SortTrait;

    /**
     * @return HttpRequest
     * @internal
     */
    public function httpRequest()
    {
        return new HttpRequest(HttpMethod::GET, $this->getPath());
    }

    /**
     * @param $response
     * @return PagedQueryResponse
     * @internal
     */
    public function buildResponse($response)
    {
        return new PagedQueryResponse($response, $this);
    }
}
