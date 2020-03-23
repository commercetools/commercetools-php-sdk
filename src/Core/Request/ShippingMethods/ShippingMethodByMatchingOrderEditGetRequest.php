<?php

namespace Commercetools\Core\Request\ShippingMethods;

use Commercetools\Core\Client\HttpMethod;
use Commercetools\Core\Client\HttpRequest;
use Commercetools\Core\Model\Common\Collection;
use Commercetools\Core\Model\Common\Context;
use Commercetools\Core\Model\JsonObjectMapper;
use Commercetools\Core\Model\MapperInterface;
use Commercetools\Core\Model\ShippingMethod\ShippingMethodCollection;
use Commercetools\Core\Request\AbstractApiRequest;
use Commercetools\Core\Request\ExpandTrait;
use Commercetools\Core\Response\ApiResponseInterface;
use Commercetools\Core\Response\PagedQueryResponse;
use Psr\Http\Message\ResponseInterface;

/**
 * @package Commercetools\Core\Request\ShippingMethods
 * @link https://docs.commercetools.com/http-api-projects-shippingMethods.html#get-shippingmethods-for-an-orderedit
 * @method ShippingMethodCollection mapResponse(ApiResponseInterface $response)
 * @method ShippingMethodCollection mapFromResponse(ApiResponseInterface $response, MapperInterface $mapper = null)
 */
class ShippingMethodByMatchingOrderEditGetRequest extends AbstractApiRequest
{
    use ExpandTrait;

    protected $resultClass = ShippingMethodCollection::class;

    /**
     * @var string
     */
    protected $country;

    /**
     * @var string
     */
    protected $orderEditId;

    /**
     * @var string
     */
    protected $state;

    /**
     * @param string $orderEditId
     * @param string $country
     * @param Context $context
     */
    public function __construct($orderEditId, $country, Context $context = null)
    {
        parent::__construct(ShippingMethodsEndpoint::endpoint(), $context);
        $this->withOrderEditId($orderEditId);
        $this->withCountry($country);
    }

    /**
     * @param string $country
     * @return $this
     */
    public function withCountry($country)
    {
        return $this->addParam('country', $country);
    }

    /**
     * @param string $orderEditId
     * @return $this
     */
    public function withOrderEditId($orderEditId)
    {
        return $this->addParam('orderEditId', $orderEditId);
    }

    /**
     * @param string $state
     * @return $this
     */
    public function withState($state)
    {
        return $this->addParam('state', $state);
    }

    /**
     * @param string $orderEditId
     * @param string $country
     * @param Context $context
     * @return static
     */
    public static function ofOrderEditAndCountry($orderEditId, $country, Context $context = null)
    {
        return new static($orderEditId, $country, $context);
    }

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
     */
    public function buildResponse(ResponseInterface $response)
    {
        return new PagedQueryResponse($response, $this, $this->getContext());
    }

    /**
     * @return string
     * @internal
     */
    protected function getPath()
    {
        return (string)$this->getEndpoint() . '/matching-orderedit' .  $this->getParamString();
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
