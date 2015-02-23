<?php
/**
 * @author @ct-jensschulze <jens.schulze@commercetools.de>
 */

namespace Sphere\Core\Request\Customers\Command;

use Sphere\Core\Request\AbstractAction;

/**
 * Class CustomerSetDefaultShippingAddressAction
 * @package Sphere\Core\Request\Customers\Command
 * @method string getAddressId()
 * @method CustomerSetDefaultShippingAddressAction setAddressId(string $addressId)
 * @method string getAction()
 * @method CustomerSetDefaultShippingAddressAction setAction(string $action)
 */
class CustomerSetDefaultShippingAddressAction extends AbstractAction
{
    public function getFields()
    {
        return [
            'action' => [static::TYPE => 'string'],
            'addressId' => [static::TYPE => 'string']
        ];
    }

    public function __construct()
    {
        $this->setAction('setDefaultShippingAddress');
    }
}
