<?php
/**
 * @author @ct-jensschulze <jens.schulze@commercetools.de>
 * @created: 11.02.15, 14:17
 */

namespace Sphere\Core\Request\Customers;

use Sphere\Core\Model\Common\Context;
use Sphere\Core\Request\AbstractFetchByIdRequest;

/**
 * Class CustomerFetchByIdRequest
 * @package Sphere\Core\Request\Customers
 * @method static CustomerFetchByIdRequest of(string $id)
 */
class CustomerFetchByIdRequest extends AbstractFetchByIdRequest
{
    /**
     * @param string $id
     * @param Context $context
     */
    public function __construct($id, Context $context = null)
    {
        parent::__construct(CustomersEndpoint::endpoint(), $id, $context);
    }
}
