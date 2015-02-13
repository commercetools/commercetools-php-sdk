<?php
/**
 * @author @ct-jensschulze <jens.schulze@commercetools.de>
 * @created: 11.02.15, 14:19
 */

namespace Sphere\Core\Request\Customers;


use Sphere\Core\Request\AbstractQueryRequest;

/**
 * Class CustomersQueryRequest
 * @package Sphere\Core\Request\Customers
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
