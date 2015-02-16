<?php
/**
 * @author @ct-jensschulze <jens.schulze@commercetools.de>
 */

namespace Sphere\Core\Request\Carts;


use Sphere\Core\Request\AbstractQueryRequest;
use Sphere\Core\Request\CustomerIdTrait;

/**
 * Class CustomersQueryRequest
 * @package Sphere\Core\Request\Customers
 * @method static CartsQueryRequest of()
 */
class CartsQueryRequest extends AbstractQueryRequest
{
    use CustomerIdTrait;

    /**
     *
     */
    public function __construct()
    {
        parent::__construct(CartsEndpoint::endpoint());
    }
}
