<?php
/**
 * @author @ct-jensschulze <jens.schulze@commercetools.de>
 * @created: 11.02.15, 14:20
 */

namespace Sphere\Core\Request\Customers;

use Sphere\Core\Model\Common\Context;
use Sphere\Core\Model\Customer\CustomerDraft;
use Sphere\Core\Request\AbstractCreateRequest;
use Sphere\Core\Model\Customer\Customer;
use Sphere\Core\Response\ApiResponseInterface;
use Sphere\Core\Model\Customer\CustomerSigninResult;

/**
 * @package Sphere\Core\Request\Customers
 * @apidoc http://dev.sphere.io/http-api-projects-customers.html#create-customer
 * @method CustomerSigninResult mapResponse(ApiResponseInterface $response)
 */
class CustomerCreateRequest extends AbstractCreateRequest
{
    protected $resultClass = '\Sphere\Core\Model\Customer\CustomerSigninResult';

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
