<?php
/**
 * @author @ct-jensschulze <jens.schulze@commercetools.de>
 * @created: 26.01.15, 17:27
 */

namespace Sphere\Core\Request;

use Psr\Http\Message\ResponseInterface;
use Sphere\Core\Client;
use Sphere\Core\Client\HttpRequest;
use Sphere\Core\Client\HttpMethod;
use Sphere\Core\Model\Common\Collection;
use Sphere\Core\Model\Common\Context;
use Sphere\Core\Response\PagedQueryResponse;

/**
 * Class AbstractQueryRequest
 * @package Sphere\Core\Request
 * @method PagedQueryResponse executeWithClient(Client $client)
 */
abstract class AbstractQueryRequest extends AbstractApiRequest
{
    use QueryTrait;
    use PageTrait;
    use SortTrait;
    use ExpandTrait;
    use WithTotalTrait;

    protected $resultClass = '\Sphere\Core\Model\Common\Collection';

    /**
     * @return HttpRequest
     * @internal
     */
    public function httpRequest()
    {
        return new HttpRequest(HttpMethod::GET, $this->getPath());
    }

    /**
     * @param ResponseInterface $response
     * @return PagedQueryResponse
     * @internal
     */
    public function buildResponse(ResponseInterface $response)
    {
        return new PagedQueryResponse($response, $this, $this->getContext());
    }

    /**
     * @param array $result
     * @param Context $context
     * @return Collection
     */
    public function mapResult(array $result, Context $context = null)
    {
        $data = [];
        if (!empty($result['results'])) {
            $data = $result['results'];
        }
        $object = forward_static_call_array([$this->resultClass, 'fromArray'], [$data, $context]);
        return $object;
    }
}
