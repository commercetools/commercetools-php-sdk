<?php
/**
 * @author @jayS-de <jens.schulze@commercetools.de>
 */


namespace Commercetools\Core\Request\GraphQL;

use Commercetools\Core\Client\HttpMethod;
use Commercetools\Core\Client\HttpRequest;
use Commercetools\Core\Model\Common\Context;
use Commercetools\Core\Request\AbstractApiRequest;
use Commercetools\Core\Response\ResourceResponse;
use Psr\Http\Message\ResponseInterface;
use Commercetools\Core\Model\Common\JsonObject;
use Commercetools\Core\Response\ApiResponseInterface;

/**
 * @package Commercetools\Core\Request\GraphQL
 *
 * @method JsonObject mapResponse(ApiResponseInterface $response)
 */
class GraphQLQueryRequest extends AbstractApiRequest
{
    /**
     * @param Context $context
     */
    public function __construct(Context $context = null)
    {
        parent::__construct(GraphQLEndpoint::endpoint(), $context);
    }

    public function buildResponse(ResponseInterface $response)
    {
        return new ResourceResponse($response, $this, $this->getContext());
    }

    public function httpRequest()
    {
        return new HttpRequest(HttpMethod::GET, $this->getPath());
    }

    public function query($query)
    {
        $this->addParam('query', $query);
    }

    public static function of(Context $context = null)
    {
        return new static($context);
    }
}
