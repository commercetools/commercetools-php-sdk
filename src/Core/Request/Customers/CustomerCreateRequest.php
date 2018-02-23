<?php
/**
 * @author @jenschude <jens.schulze@commercetools.de>
 * @created: 11.02.15, 14:20
 */

namespace Commercetools\Core\Request\Customers;

use Commercetools\Core\Model\Common\Context;
use Commercetools\Core\Model\Customer\CustomerDraft;
use Commercetools\Core\Request\AbstractCreateRequest;
use Commercetools\Core\Model\Customer\Customer;
use Commercetools\Core\Response\ApiResponseInterface;
use Commercetools\Core\Model\Customer\CustomerSigninResult;
use Commercetools\Core\Model\MapperInterface;

/**
 * @package Commercetools\Core\Request\Customers
 * @link https://docs.commercetools.com/http-api-projects-customers.html#create-customer-sign-up
 * @method CustomerSigninResult mapResponse(ApiResponseInterface $response)
 * @method CustomerSigninResult mapFromResponse(ApiResponseInterface $response, MapperInterface $mapper = null)
 */
class CustomerCreateRequest extends AbstractCreateRequest
{
    protected $resultClass = CustomerSigninResult::class;

    /**
     * @param CustomerDraft $customer
     * @param Context $context
     */
    public function __construct(CustomerDraft $customer, Context $context = null)
    {
        parent::__construct(CustomersEndpoint::endpoint(), $customer, $context);
    }

    /**
     * @param CustomerDraft $customer
     * @param Context $context
     * @return static
     */
    public static function ofDraft(CustomerDraft $customer, Context $context = null)
    {
        return new static($customer, $context);
    }
}
