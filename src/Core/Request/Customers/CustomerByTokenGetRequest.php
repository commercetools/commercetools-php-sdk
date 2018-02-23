<?php
/**
 * @author @jenschude <jens.schulze@commercetools.de>
 * @created: 12.02.15, 10:35
 */

namespace Commercetools\Core\Request\Customers;

use Commercetools\Core\Request\AbstractByTokenGetRequest;
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
 * @link https://docs.commercetools.com/http-api-projects-customers.html#get-customer-by-password-token
 * @method Customer mapResponse(ApiResponseInterface $response)
 * @method Customer mapFromResponse(ApiResponseInterface $response, MapperInterface $mapper = null)
 */
class CustomerByTokenGetRequest extends AbstractByTokenGetRequest
{
    const TOKEN_NAME = 'password-token';

    protected $resultClass = Customer::class;
    /**
     * @param string $token
     * @param Context $context
     */
    public function __construct($token, Context $context = null)
    {
        parent::__construct(CustomersEndpoint::endpoint(), $token, $context);
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
}
