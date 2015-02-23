<?php
/**
 * @author @ct-jensschulze <jens.schulze@commercetools.de>
 * @created: 11.02.15, 14:19
 */

namespace Sphere\Core\Request\Customers;


use Sphere\Core\Model\Common\Context;
use Sphere\Core\Request\AbstractQueryRequest;

/**
 * Class CustomersQueryRequest
 * @package Sphere\Core\Request\Customers
 * @method static CustomersQueryRequest of()
 */
class CustomersQueryRequest extends AbstractQueryRequest
{
    /**
     * @param Context $context
     */
    public function __construct(Context $context = null)
    {
        parent::__construct(CustomersEndpoint::endpoint(), $context);
    }
}
