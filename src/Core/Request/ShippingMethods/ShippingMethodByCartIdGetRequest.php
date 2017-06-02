<?php
/**
 * @author @jayS-de <jens.schulze@commercetools.de>
 */

namespace Commercetools\Core\Request\ShippingMethods;

use Commercetools\Core\Response\ResourceResponse;
use Psr\Http\Message\ResponseInterface;
use Commercetools\Core\Client\HttpMethod;
use Commercetools\Core\Client\HttpRequest;
use Commercetools\Core\Model\Common\Context;
use Commercetools\Core\Request\AbstractApiRequest;
use Commercetools\Core\Response\PagedQueryResponse;
use Commercetools\Core\Model\ShippingMethod\ShippingMethodCollection;
use Commercetools\Core\Response\ApiResponseInterface;
use Commercetools\Core\Model\MapperInterface;

/**
 * @package Commercetools\Core\Request\ShippingMethods
 * @link https://dev.commercetools.com/http-api-projects-shippingMethods.html#get-shippingmethods-for-a-cart
 * @method ShippingMethodCollection mapResponse(ApiResponseInterface $response)
 * @method ShippingMethodCollection mapFromResponse(ApiResponseInterface $response, MapperInterface $mapper = null)
 */
class ShippingMethodByCartIdGetRequest extends AbstractApiRequest
{
    protected $resultClass = ShippingMethodCollection::class;

    /**
     * @var string
     */
    protected $cartId;

    /**
     * @param string $cartId
     * @param Context $context
     */
    public function __construct($cartId, Context $context = null)
    {
        parent::__construct(ShippingMethodsEndpoint::endpoint(), $context);
        $this->withCartId($cartId);
    }

    /**
     * @param string $cartId
     * @return $this
     */
    public function withCartId($cartId)
    {
        return $this->addParam('cartId', $cartId);
    }

    /**
     * @param string $cartId
     * @param Context $context
     * @return static
     */
    public static function ofCartId($cartId, Context $context = null)
    {
        return new static($cartId, $context);
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
        return new ResourceResponse($response, $this, $this->getContext());
    }
}
