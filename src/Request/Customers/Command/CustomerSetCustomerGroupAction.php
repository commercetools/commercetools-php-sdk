<?php
/**
 * @author @ct-jensschulze <jens.schulze@commercetools.de>
 */

namespace Sphere\Core\Request\Customers\Command;

use Sphere\Core\Model\CustomerGroup\CustomerGroupReference;
use Sphere\Core\Request\AbstractAction;

/**
 * Class CustomerAddAddressAction
 * @package Sphere\Core\Request\Customers\Command
 * @method CustomerGroupReference getCustomerGroup()
 * @method CustomerAddAddressAction setCustomerGroup(CustomerGroupReference $customerGroup)
 */
class CustomerSetCustomerGroupAction extends AbstractAction
{
    public function getFields()
    {
        return [
            'action' => [static::TYPE => 'string'],
            'customerGroup' => [static::TYPE => '\Sphere\Core\Model\CustomerGroup\CustomerGroupReference'],
        ];
    }

    public function __construct()
    {
        $this->setAction('setCustomerGroup');
    }
}
