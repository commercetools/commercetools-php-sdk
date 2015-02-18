<?php
/**
 * @author @ct-jensschulze <jens.schulze@commercetools.de>
 */

namespace Sphere\Core\Request\Customers\Command;

use Sphere\Core\Model\Common\Address;
use Sphere\Core\Request\AbstractAction;

/**
 * Class CustomerAddAddressAction
 * @package Sphere\Core\Request\Customers\Command
 * @method Address getAddress()
 * @method CustomerAddAddressAction setAddress(Address $address)
 */
class CustomerAddAddressAction extends AbstractAction
{
    public function getFields()
    {
        return [
            'action' => [static::TYPE => 'string'],
            'address' => [static::TYPE => '\Sphere\Core\Model\Common\Address'],
        ];
    }

    /**
     * @param Address $address
     */
    public function __construct(Address $address)
    {
        $this->setAction('addAddress');
        $this->setAddress($address);
    }
}
