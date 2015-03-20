<?php
/**
 * @author @ct-jensschulze <jens.schulze@commercetools.de>
 * @created: 11.02.15, 14:35
 */

namespace Sphere\Core\Request\Customers;


use Sphere\Core\Model\Common\Address;
use Sphere\Core\Model\Common\Context;
use Sphere\Core\Model\CustomerGroup\CustomerGroupReference;
use Sphere\Core\Request\AbstractUpdateRequest;

/**
 * Class CustomerUpdateRequest
 * @package Sphere\Core\Request\Customers
 * @method static CustomerUpdateRequest of(string $id, int $version, array $actions = [])
 */
class CustomerUpdateRequest extends AbstractUpdateRequest
{
    protected $resultClass = '\Sphere\Core\Model\Customer\Customer';

    /**
     * @param string $id
     * @param int $version
     * @param array $actions
     * @param Context $context
     */
    public function __construct($id, $version, array $actions = [], Context $context = null)
    {
        parent::__construct(CustomersEndpoint::endpoint(), $id, $version, $actions, $context);
    }
}
