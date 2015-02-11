<?php
/**
 * @author @ct-jensschulze <jens.schulze@commercetools.de>
 * @created: 11.02.15, 14:17
 */

namespace Sphere\Core\Request\Customer;


use Sphere\Core\Request\AbstractFetchByIdRequest;

/**
 * Class CustomerFetchByIdRequest
 * @package Sphere\Core\Request\Customer
 * @method static CustomerFetchByIdRequest of(string $id)
 */
class CustomerFetchByIdRequest extends AbstractFetchByIdRequest
{
    /**
     * @param string $id
     */
    public function __construct($id)
    {
        parent::__construct(CustomersEndpoint::endpoint(), $id);
    }
}
