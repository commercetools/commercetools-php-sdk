<?php
/**
 * @author @ct-jensschulze <jens.schulze@commercetools.de>
 * @created: 26.01.15, 17:27
 */

namespace Sphere\Core\Request;

use Sphere\Core\Http\HttpRequest;
use Sphere\Core\Http\HttpMethod;
use Sphere\Core\Response\PagedQueryResponse;

/**
 * Class AbstractQueryRequest
 * @package Sphere\Core\Request
 */
abstract class AbstractQueryRequest extends AbstractApiRequest
{
    use QueryTrait;
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
