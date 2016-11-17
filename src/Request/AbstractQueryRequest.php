<?php
/**
 * @author @jayS-de <jens.schulze@commercetools.de>
 * @created: 26.01.15, 17:27
 */

namespace Commercetools\Core\Request;

use Commercetools\Core\Model\JsonObjectMapper;
use Commercetools\Core\Model\MapperInterface;
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
     * @param MapperInterface $mapper
     * @return Collection
     */
    public function map(array $result, Context $context = null, MapperInterface $mapper = null)
    {
        $data = [];
        if (!empty($result['results'])) {
            $data = $result['results'];
        }
        if (is_null($mapper)) {
            $mapper = JsonObjectMapper::of($context);
        }
        return $mapper->map($data, $this->resultClass);
    }
}
