<?php
/**
 * @author @ct-jensschulze <jens.schulze@commercetools.de>
 */

namespace Sphere\Core\Request\Customers\Command;

use Sphere\Core\Request\AbstractAction;

/**
 * Class CustomerRemoveAddressAction
 * @package Sphere\Core\Request\Customers\Command
 * @method string getAddressId()
 * @method CustomerRemoveAddressAction setAddressId(string $addressId)
 * @method string getAction()
 * @method CustomerRemoveAddressAction setAction(string $action)
 */
class CustomerRemoveAddressAction extends AbstractAction
{
    public function getFields()
    {
        return [
            'action' => [static::TYPE => 'string'],
            'addressId' => [static::TYPE => 'string']
        ];
    }

    /**
     * @param string $addressId
     */
    public function __construct($addressId)
    {
        $this->setAction('removeAddress');
        $this->setAddressId($addressId);
    }
}
