<?php
/**
 * @author @jenschude <jens.schulze@commercetools.de>
 */

namespace Commercetools\Core\Request\Customers\Command;

use Commercetools\Core\Model\Common\Address;
use Commercetools\Core\Model\Common\Context;
use Commercetools\Core\Request\AbstractAction;

/**
 * @package Commercetools\Core\Request\Customers\Command
 * @link https://docs.commercetools.com/http-api-projects-customers.html#change-address
 * @method string getAddressId()
 * @method Address getAddress()
 * @method CustomerChangeAddressAction setAddressId(string $addressId = null)
 * @method CustomerChangeAddressAction setAddress(Address $address = null)
 * @method string getAction()
 * @method CustomerChangeAddressAction setAction(string $action = null)
 * @method string getAddressKey()
 * @method CustomerChangeAddressAction setAddressKey(string $addressKey = null)
 */
class CustomerChangeAddressAction extends AbstractAction
{
    public function fieldDefinitions()
    {
        return [
            'action' => [static::TYPE => 'string'],
            'addressId' => [static::TYPE => 'string'],
            'addressKey' => [static::TYPE => 'string'],
            'address' => [static::TYPE => Address::class],
        ];
    }

    /**
     * @param array $data
     * @param Context|callable $context
     */
    public function __construct(array $data = [], $context = null)
    {
        parent::__construct($data, $context);
        $this->setAction('changeAddress');
    }

    /**
     * @param string $addressId
     * @param Address $address
     * @param Context|callable $context
     * @return CustomerChangeAddressAction
     */
    public static function ofAddressIdAndAddress($addressId, Address $address, $context = null)
    {
        return static::of($context)->setAddressId($addressId)->setAddress($address);
    }

    /**
     * @param $addressKey
     * @param Address $address
     * @param Context|callable $context
     * @return CustomerChangeAddressAction
     */
    public static function ofAddressKeyAndAddress($addressKey, Address $address, $context = null)
    {
        return static::of($context)->setAddressKey($addressKey)->setAddress($address);
    }
}
