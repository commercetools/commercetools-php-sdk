<?php
/**
 * @author @ct-jensschulze <jens.schulze@commercetools.de>
 * @created: 11.02.15, 14:20
 */

namespace Sphere\Core\Request\Customer;


use Sphere\Core\Model\Customer\CustomerDraft;
use Sphere\Core\Request\AbstractCreateRequest;

/**
 * Class CustomerCreateRequest
 * @package Sphere\Core\Request\Customer
 * @method static CustomerCreateRequest of(CustomerDraft $customer)
 */
class CustomerCreateRequest extends AbstractCreateRequest
{
    /**
     * @param CustomerDraft $customer
     */
    public function __construct(CustomerDraft $customer)
    {
        parent::__construct(CustomersEndpoint::endpoint(), $customer);
    }
}
