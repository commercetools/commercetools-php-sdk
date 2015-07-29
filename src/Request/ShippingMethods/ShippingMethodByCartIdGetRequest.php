<?php
/**
 * @author @ct-jensschulze <jens.schulze@commercetools.de>
 */

namespace Sphere\Core\Request\ShippingMethods;


use Psr\Http\Message\ResponseInterface;
use Sphere\Core\Client\HttpMethod;
use Sphere\Core\Client\HttpRequest;
use Sphere\Core\Model\Common\Context;
use Sphere\Core\Request\AbstractApiRequest;
use Sphere\Core\Response\PagedQueryResponse;

class ShippingMethodByCartIdGetRequest extends AbstractApiRequest
{
    protected $resultClass = '\Sphere\Core\Model\ShippingMethod\ShippingMethodCollection';

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
        return new PagedQueryResponse($response, $this, $this->getContext());
    }
}
