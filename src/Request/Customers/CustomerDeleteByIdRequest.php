<?php
/**
 * @author @ct-jensschulze <jens.schulze@commercetools.de>
 * @created: 12.02.15, 12:12
 */

namespace Sphere\Core\Request\Customers;

use Sphere\Core\Model\Common\Context;
use Sphere\Core\Request\AbstractDeleteByIdRequest;

/**
 * Class CustomerDeleteByIdRequest
 * @package Sphere\Core\Request\Customers
 * @method static CustomerDeleteByIdRequest of(string $id, int $version)
 */
class CustomerDeleteByIdRequest extends AbstractDeleteByIdRequest
{
    /**
     * @param string $id
     * @param int $version
     * @param Context $context
     */
    public function __construct($id, $version, Context $context = null)
    {
        parent::__construct(CustomersEndpoint::endpoint(), $id, $version, $context);
    }
}
