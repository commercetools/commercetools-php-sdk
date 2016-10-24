<?php
/**
 * @author @jayS-de <jens.schulze@commercetools.de>
 * @created: 12.02.15, 10:35
 */

namespace Commercetools\Core\Request\Customers;

use Psr\Http\Message\ResponseInterface;
use Commercetools\Core\Client\HttpMethod;
use Commercetools\Core\Client\HttpRequest;
use Commercetools\Core\Model\Common\Context;
use Commercetools\Core\Request\AbstractApiRequest;
use Commercetools\Core\Response\ResourceResponse;
use Commercetools\Core\Model\Customer\Customer;
use Commercetools\Core\Response\ApiResponseInterface;
use Commercetools\Core\Model\MapperInterface;

/**
 * @package Commercetools\Core\Request\Customers
 * @link https://dev.commercetools.com/http-api-projects-customers.html#get-customer-by-password-token
 * @method Customer mapResponse(ApiResponseInterface $response)
 * @method Customer mapFromResponse(ApiResponseInterface $response, MapperInterface $mapper = null)
 */
class CustomerByTokenGetRequest extends AbstractApiRequest
{
    const TOKEN = 'token';

    protected $resultClass = '\Commercetools\Core\Model\Customer\Customer';

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
     * @param string $token
     * @param Context $context
     * @return static
     */
    public static function ofToken($token, Context $context = null)
    {
        return new static($token, $context);
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
     * @internal
     */
    public function buildResponse(ResponseInterface $response)
    {
        return new ResourceResponse($response, $this, $this->getContext());
    }
}
