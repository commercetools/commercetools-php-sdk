<?php
/**
 * @author @ct-jensschulze <jens.schulze@commercetools.de>
 */

namespace Sphere\Core\Request\Customers\Command;

use Sphere\Core\Request\AbstractAction;

/**
 * Class CustomerSetDefaultBillingAddressAction
 * @package Sphere\Core\Request\Customers\Command
 * @method string getAddressId()
 * @method CustomerSetDefaultBillingAddressAction setAddressId(string $addressId = null)
 * @method string getAction()
 * @method CustomerSetDefaultBillingAddressAction setAction(string $action = null)
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
