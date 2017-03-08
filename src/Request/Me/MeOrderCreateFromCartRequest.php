<?php
/**
 * @author @jayS-de <jens.schulze@commercetools.de>
 */

namespace Commercetools\Core\Request\Me;

use Psr\Http\Message\ResponseInterface;
use Commercetools\Core\Client\HttpMethod;
use Commercetools\Core\Client\HttpRequestInterface;
use Commercetools\Core\Client\JsonRequest;
use Commercetools\Core\Model\Common\Context;
use Commercetools\Core\Request\AbstractApiRequest;
use Commercetools\Core\Response\AbstractApiResponse;
use Commercetools\Core\Response\ResourceResponse;
use Commercetools\Core\Model\Order\Order;
use Commercetools\Core\Response\ApiResponseInterface;
use Commercetools\Core\Model\MapperInterface;

/**
 * @package Commercetools\Core\Request\Me
 * @link https://dev.commercetools.com/http-api-projects-me-orders.html#create-order-from-a-cart
 * @method Order mapResponse(ApiResponseInterface $response)
 * @method Order mapFromResponse(ApiResponseInterface $response, MapperInterface $mapper = null)
 */
class MeOrderCreateFromCartRequest extends AbstractApiRequest
{
    const ID = 'id';
    const VERSION = 'version';

    protected $cartId;
    protected $version;

    protected $resultClass = Order::class;

    /**
     * @return mixed
     */
    public function getCartId()
    {
        return $this->cartId;
    }

    /**
     * @param $cartId
     * @return $this
     */
    public function setCartId($cartId)
    {
        $this->cartId = $cartId;

        return $this;
    }

    /**
     * @return mixed
     */
    public function getVersion()
    {
        return $this->version;
    }

    /**
     * @param $version
     * @return $this
     */
    public function setVersion($version)
    {
        $this->version = $version;

        return $this;
    }

    /**
     * @param string $cartId
     * @param int $version
     * @param Context $context
     */
    public function __construct($cartId, $version, Context $context = null)
    {
        parent::__construct(MeOrdersEndpoint::endpoint(), $context);
        $this->setCartId($cartId)->setVersion($version);
    }

    /**
     * @param string $cartId
     * @param int $version
     * @param Context $context
     * @return static
     */
    public static function ofCartIdAndVersion($cartId, $version, Context $context = null)
    {
        return new static($cartId, $version, $context);
    }

    /**
     * @param ResponseInterface $response
     * @return AbstractApiResponse
     * @internal
     */
    public function buildResponse(ResponseInterface $response)
    {
        return new ResourceResponse($response, $this, $this->getContext());
    }

    /**
     * @return HttpRequestInterface
     * @internal
     */
    public function httpRequest()
    {
        $payload = [
            static::ID => $this->getCartId(),
            static::VERSION => $this->getVersion(),
        ];

        return new JsonRequest(HttpMethod::POST, $this->getPath(), $payload);
    }
}
