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
 * @method CustomerRemoveBillingAddressAction setAddressId(string $addressId = null)
 * @method string getAction()
 * @method CustomerRemoveBillingAddressAction setAction(string $action = null)
 * @method string getAddressKey()
 * @method CustomerRemoveBillingAddressAction setAddressKey(string $addressKey = null)
 */
class CustomerRemoveBillingAddressAction extends AbstractAction
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
        $this->setAction('removeBillingAddressId');
    }


    /**
     * @param string $addressId
     * @param Context|callable $context
     * @return CustomerRemoveBillingAddressAction
     */
    public static function ofAddressId($addressId, $context = null)
    {
        return static::of($context)->setAddressId($addressId);
    }

    /**
     * @param string $addressKey
     * @param Context|callable $context
     * @return CustomerRemoveBillingAddressAction
     */
    public static function ofAddressKey($addressKey, $context = null)
    {
        return static::of($context)->setAddressKey($addressKey);
    }
}
