<?php
/**
 * @author @ct-jensschulze <jens.schulze@commercetools.de>
 */

namespace Sphere\Core\Request\Carts;

use Sphere\Core\Request\AbstractFetchByIdRequest;

/**
 * Class CustomerFetchByIdRequest
 * @package Sphere\Core\Request\Customers
 * @method static CartFetchByIdRequest of(string $id)
 */
class CartFetchByIdRequest extends AbstractFetchByIdRequest
{
    /**
     * @param string $id
     */
    public function __construct($id)
    {
        parent::__construct(CartsEndpoint::endpoint(), $id);
    }
}
