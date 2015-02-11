<?php
/**
 * @author @ct-jensschulze <jens.schulze@commercetools.de>
 * @created: 11.02.15, 14:19
 */

namespace Sphere\Core\Request\Customer;


use Sphere\Core\Request\AbstractQueryRequest;

/**
 * Class CustomersQueryRequest
 * @package Sphere\Core\Request\Customer
 * @method static CustomersQueryRequest of()
 */
class CustomersQueryRequest extends AbstractQueryRequest
{
    /**
     *
     */
    public function __construct()
    {
        parent::__construct(CustomersEndpoint::endpoint());
    }
}
