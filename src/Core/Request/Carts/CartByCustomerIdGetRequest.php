<?php
/**
 * @author @jenschude <jens.schulze@commercetools.de>
 */

namespace Commercetools\Core\Request\Carts;

use Commercetools\Core\Request\InStores\InStoreRequestDecorator;
use Commercetools\Core\Request\InStores\InStoreTrait;
use Psr\Http\Message\ResponseInterface;
use Commercetools\Core\Client\HttpMethod;
use Commercetools\Core\Client\HttpRequest;
use Commercetools\Core\Model\Common\Context;
use Commercetools\Core\Request\AbstractApiRequest;
use Commercetools\Core\Request\CustomerIdTrait;
use Commercetools\Core\Response\ResourceResponse;
use Commercetools\Core\Model\Cart\Cart;
use Commercetools\Core\Response\ApiResponseInterface;
use Commercetools\Core\Model\MapperInterface;

/**
 * @package Commercetools\Core\Request\Carts
 * @link https://docs.commercetools.com/http-api-projects-carts.html#get-cart-by-customer-id
 * @method Cart mapResponse(ApiResponseInterface $response)
 * @method Cart mapFromResponse(ApiResponseInterface $response, MapperInterface $mapper = null)
 * @method CartByCustomerIdGetRequest|InStoreRequestDecorator inStore($storeKey)
 */
class CartByCustomerIdGetRequest extends AbstractApiRequest
{
    use CustomerIdTrait;
    use InStoreTrait;

    protected $resultClass = Cart::class;

    /**
     * @param string $customerId
     * @param Context $context
     */
    public function __construct($customerId, Context $context = null)
    {
        parent::__construct(CartsEndpoint::endpoint(), $context);
        $this->byCustomerId($customerId);
    }

    /**
     * @param string $customerId
     * @param Context $context
     * @return static
     */
    public static function ofCustomerId($customerId, Context $context = null)
    {
        return new static($customerId, $context);
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
     * @return ResourceResponse
     */
    public function buildResponse(ResponseInterface $response)
    {
        return new ResourceResponse($response, $this, $this->getContext());
    }
}
