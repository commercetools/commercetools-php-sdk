<?php
/**
 * @author @jenschude <jens.schulze@commercetools.de>
 */

namespace Commercetools\Core\Request\Customers\Command;

use Commercetools\Core\Model\Common\Context;
use Commercetools\Core\Request\AbstractAction;

/**
 * @package Commercetools\Core\Request\Customers\Command
 * @link https://docs.commercetools.com/http-api-projects-customers.html#add-billing-address-id
 * @method string getAddressId()
 * @method CustomerAddShippingAddressAction setAddressId(string $addressId = null)
 * @method string getAction()
 * @method CustomerAddShippingAddressAction setAction(string $action = null)
 * @method string getAddressKey()
 * @method CustomerAddShippingAddressAction setAddressKey(string $addressKey = null)
 */
class CustomerAddShippingAddressAction extends AbstractAction
{
    public function fieldDefinitions()
    {
        return [
            'action' => [static::TYPE => 'string'],
            'addressId' => [static::TYPE => 'string'],
            'addressKey' => [static::TYPE => 'string'],
        ];
    }

    /**
     * @param array $data
     * @param Context|callable $context
     */
    public function __construct(array $data = [], $context = null)
    {
        parent::__construct($data, $context);
        $this->setAction('addShippingAddressId');
    }

    /**
     * @param string $addressId
     * @param Context|callable $context
     * @return CustomerAddShippingAddressAction
     */
    public static function ofAddressId($addressId, $context = null)
    {
        return static::of($context)->setAddressId($addressId);
    }

    /**
     * @param string $addressKey
     * @param Context|callable $context
     * @return CustomerAddShippingAddressAction
     */
    public static function ofAddressKey($addressKey, $context = null)
    {
        return static::of($context)->setAddressKey($addressKey);
    }
}
