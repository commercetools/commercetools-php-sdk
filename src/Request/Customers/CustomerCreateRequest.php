<?php
/**
 * @author @ct-jensschulze <jens.schulze@commercetools.de>
 * @created: 11.02.15, 14:20
 */

namespace Sphere\Core\Request\Customers;

use Sphere\Core\Model\Common\Context;
use Sphere\Core\Model\Customer\CustomerDraft;
use Sphere\Core\Request\AbstractCreateRequest;

/**
 * Class CustomerCreateRequest
 * @package Sphere\Core\Request\Customers
 * @link http://dev.sphere.io/http-api-projects-customers.html#create-customer
 * @method static CustomerCreateRequest of(CustomerDraft $customer)
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
}
