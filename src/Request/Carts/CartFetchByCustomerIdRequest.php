<?php
/**
 * @author @ct-jensschulze <jens.schulze@commercetools.de>
 */

namespace Sphere\Core\Request\Carts;


use GuzzleHttp\Message\ResponseInterface;
use Sphere\Core\Client\HttpMethod;
use Sphere\Core\Client\HttpRequest;
use Sphere\Core\Model\Cart\Cart;
use Sphere\Core\Model\Common\Context;
use Sphere\Core\Request\AbstractApiRequest;
use Sphere\Core\Request\CustomerIdTrait;
use Sphere\Core\Response\SingleResourceResponse;

class CartFetchByCustomerIdRequest extends AbstractApiRequest
{
    use CustomerIdTrait;

    protected $resultClass = '\Sphere\Core\Model\Cart\Cart';

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
     * @return HttpRequest
     * @internal
     */
    public function httpRequest()
    {
        return new HttpRequest(HttpMethod::GET, $this->getPath());
    }

    /**
     * @param ResponseInterface $response
     * @return SingleResourceResponse
     */
    public function buildResponse(ResponseInterface $response)
    {
        return new SingleResourceResponse($response, $this, $this->getContext());
    }
}
