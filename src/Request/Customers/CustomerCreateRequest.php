<?php
/**
 * @author @jayS-de <jens.schulze@commercetools.de>
 * @created: 11.02.15, 14:20
 */

namespace Commercetools\Core\Request\Customers;

use Commercetools\Core\Model\Common\Context;
use Commercetools\Core\Model\Customer\CustomerDraft;
use Commercetools\Core\Request\AbstractCreateRequest;
use Commercetools\Core\Model\Customer\Customer;
use Commercetools\Core\Response\ApiResponseInterface;
use Commercetools\Core\Model\Customer\CustomerSigninResult;

/**
 * @package Commercetools\Core\Request\Customers
 * @apidoc http://dev.sphere.io/http-api-projects-customers.html#create-customer
 * @method CustomerSigninResult mapResponse(ApiResponseInterface $response)
 */
class CustomerCreateRequest extends AbstractCreateRequest
{
    protected $resultClass = '\Commercetools\Core\Model\Customer\CustomerSigninResult';

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
