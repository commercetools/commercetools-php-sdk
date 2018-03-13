<?php
/**
 * @author @jenschude <jens.schulze@commercetools.de>
 */


namespace Commercetools\Core\Request\GraphQL;

use Commercetools\Core\Client\HttpMethod;
use Commercetools\Core\Client\JsonRequest;
use Commercetools\Core\Model\Common\Context;
use Commercetools\Core\Request\AbstractApiRequest;
use Commercetools\Core\Response\ResourceResponse;
use Psr\Http\Message\ResponseInterface;
use Commercetools\Core\Model\Common\JsonObject;
use Commercetools\Core\Response\ApiResponseInterface;
use Commercetools\Core\Model\MapperInterface;

/**
 * @package Commercetools\Core\Request\GraphQL
 *
 * @method JsonObject mapResponse(ApiResponseInterface $response)
 * @method JsonObject mapFromResponse(ApiResponseInterface $response, MapperInterface $mapper = null)
 */
class GraphQLQueryRequest extends AbstractApiRequest
{
    private $query;
    private $variables;
    private $operationName;

    /**
     * @param Context $context
     */
    public function __construct(Context $context = null)
    {
        $this->variables = [];
        parent::__construct(GraphQLEndpoint::endpoint(), $context);
    }

    public function buildResponse(ResponseInterface $response)
    {
        return new ResourceResponse($response, $this, $this->getContext());
    }

    public function httpRequest()
    {
        $body = [
            'query' => $this->query,
            'variables' => $this->variables,
            'operationName' => $this->operationName
        ];
        return new JsonRequest(HttpMethod::POST, $this->getPath(), $body);
    }

    /**
     * @param $query
     * @return $this
     */
    public function query($query)
    {
        $this->query = $query;

        return $this;
    }

    public function setVariables(array $variables)
    {
        $this->variables = $variables;
    }

    public function addVariable($name, $value)
    {
        $this->variables[$name] = $value;
    }

    public function operationName($name)
    {
        $this->operationName = $name;
    }

    public static function of(Context $context = null)
    {
        return new static($context);
    }
}
