<?php
/**
 * @author @ct-jensschulze <jens.schulze@commercetools.de>
 */

namespace Sphere\Core\Request\Carts\Command;

use Sphere\Core\Model\Common\Address;
use Sphere\Core\Request\AbstractAction;

/**
 * Class CartSetShippingAddressAction
 * @package Sphere\Core\Request\Carts\Command
 * @method string getAction()
 * @method CartSetShippingAddressAction setAction(string $action = null)
 * @method Address getAddress()
 * @method CartSetShippingAddressAction setAddress(Address $address = null)
 */
class CartSetShippingAddressAction extends AbstractAction
{
    public function getFields()
    {
        return [
            'action' => [static::TYPE => 'string'],
            'address' => [static::TYPE => '\Sphere\Core\Model\Common\Address'],
        ];
    }

    public function __construct()
    {
        $this->setAction('setShippingAddress');
    }
}
