<?php
/**
 * @author @ct-jensschulze <jens.schulze@commercetools.de>
 * @created: 12.02.15, 10:35
 */

namespace Sphere\Core\Request\Customers;

use Sphere\Core\Client\HttpMethod;
use Sphere\Core\Client\HttpRequest;
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

    /**
     * @param string $token
     */
    public function __construct($token)
    {
        parent::__construct(CustomersEndpoint::endpoint());
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
     * @param $response
     * @return SingleResourceResponse
     * @internal
     */
    public function buildResponse($response)
    {
        return new SingleResourceResponse($response, $this);
    }
}
