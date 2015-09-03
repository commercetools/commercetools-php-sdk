<?php
/**
 * @author @ct-jensschulze <jens.schulze@commercetools.de>
 * @created: 26.01.15, 17:27
 */

namespace Commercetools\Core\Request;

use Psr\Http\Message\ResponseInterface;
use Commercetools\Core\Client;
use Commercetools\Core\Client\HttpRequest;
use Commercetools\Core\Client\HttpMethod;
use Commercetools\Core\Model\Common\Collection;
use Commercetools\Core\Model\Common\Context;
use Commercetools\Core\Response\PagedQueryResponse;

/**
 * @package Commercetools\Core\Request
 * @method PagedQueryResponse executeWithClient(Client $client)
 */
abstract class AbstractQueryRequest extends AbstractApiRequest implements QueryAllRequestInterface
{
    use QueryTrait;
    use PageTrait;
    use SortTrait;
    use ExpandTrait;
    use WithTotalTrait;

    protected $resultClass = '\Commercetools\Core\Model\Common\Collection';

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
