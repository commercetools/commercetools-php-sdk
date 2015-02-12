<?php
/**
 * @author @ct-jensschulze <jens.schulze@commercetools.de>
 * @created: 12.02.15, 12:12
 */

namespace Sphere\Core\Request\Customer;

use Sphere\Core\Request\AbstractDeleteByIdRequest;

/**
 * Class CustomerDeleteByIdRequest
 * @package Sphere\Core\Request\Customer
 * @method static CustomerDeleteByIdRequest of(string $id, int $version)
 */
class CustomerDeleteByIdRequest extends AbstractDeleteByIdRequest
{
    /**
     * @param string $id
     * @param int $version
     */
    public function __construct($id, $version)
    {
        parent::__construct(CustomersEndpoint::endpoint(), $id, $version);
    }
}
