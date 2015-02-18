<?php
/**
 * @author @ct-jensschulze <jens.schulze@commercetools.de>
 */

namespace Sphere\Core\Request\Customers\Command;

use Sphere\Core\Request\AbstractAction;

/**
 * Class CustomerAddAddressAction
 * @package Sphere\Core\Request\Customers\Command
 * @method string getAddressId()
 * @method CustomerSetDefaultShippingAddressAction setAddressId(string $addressId)
 */
class CustomerSetDefaultBillingAddressAction extends AbstractAction
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
        $this->setAction('setDefaultBillingAddress');
    }
}
