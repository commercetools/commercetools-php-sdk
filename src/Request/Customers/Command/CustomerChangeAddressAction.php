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
 * @method string getAddressId()
 * @method Address getAddress()
 * @method CustomerChangeAddressAction setAddressId(string $addressId)
 * @method CustomerChangeAddressAction setAddress(Address $address)
 */
class CustomerChangeAddressAction extends AbstractAction
{
    public function getFields()
    {
        return [
            'action' => [static::TYPE => 'string'],
            'addressId' => [static::TYPE => 'string'],
            'address' => [static::TYPE => '\Sphere\Core\Model\Common\Address'],
        ];
    }

    /**
     * @param string $addressId
     * @param Address $address
     */
    public function __construct($addressId, Address $address)
    {
        $this->setAction('changeAddress');
        $this->setAddressId($addressId);
        $this->setAddress($address);
    }
}
