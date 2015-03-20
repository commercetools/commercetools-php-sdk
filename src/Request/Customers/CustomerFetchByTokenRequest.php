<?php
/**
 * @author @ct-jensschulze <jens.schulze@commercetools.de>
 * @created: 12.02.15, 10:35
 */

namespace Sphere\Core\Request\Customers;

use GuzzleHttp\Message\ResponseInterface;
use Sphere\Core\Client\HttpMethod;
use Sphere\Core\Client\HttpRequest;
use Sphere\Core\Model\Common\Context;
use Sphere\Core\Model\Common\JsonDeserializeInterface;
use Sphere\Core\Model\Common\JsonObject;
use Sphere\Core\Request\AbstractApiRequest;
use Sphere\Core\Response\SingleResourceResponse;

/**
 * Class CustomerFetchByTokenRequest
 * @package Sphere\Core\Request\Customers
 * @method static CustomerFetchByTokenRequest of(string $token)
 */
class CustomerFetchByTokenRequest extends AbstractApiRequest
{
    const TOKEN = 'token';

    protected $resultClass = '\Sphere\Core\Model\Customer\Customer';

    /**
     * @param string $token
     * @param Context $context
     */
    public function __construct($token, Context $context = null)
    {
        parent::__construct(CustomersEndpoint::endpoint(), $context);
        $this->addParam(static::TOKEN, $token);
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
     * @internal
     */
    public function buildResponse(ResponseInterface $response)
    {
        return new SingleResourceResponse($response, $this, $this->getContext());
    }
}
