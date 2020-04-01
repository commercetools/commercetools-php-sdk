<?php
/**
 * @author @jenschude <jens.schulze@commercetools.de>
 */

namespace Commercetools\Core\Request\Customers\Command;

use Commercetools\Core\Model\Common\Context;
use Commercetools\Core\Request\AbstractAction;

/**
 * @package Commercetools\Core\Request\Customers\Command
 * @link https://docs.commercetools.com/http-api-projects-customers.html#set-default-billing-address
 * @method string getAddressId()
 * @method CustomerSetDefaultBillingAddressAction setAddressId(string $addressId = null)
 * @method string getAction()
 * @method CustomerSetDefaultBillingAddressAction setAction(string $action = null)
 * @method string getAddressKey()
 * @method CustomerSetDefaultBillingAddressAction setAddressKey(string $addressKey = null)
 */
class CustomerSetDefaultBillingAddressAction extends AbstractAction
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
        $this->setAction('setDefaultBillingAddress');
    }

    /**
     * @param string $addressId
     * @param Context|callable $context
     * @return CustomerSetDefaultBillingAddressAction
     */
    public static function ofAddressId($addressId, $context = null)
    {
        return static::of($context)->setAddressId($addressId);
    }

    /**
     * @param string $addressKey
     * @param Context|callable $context
     * @return CustomerSetDefaultBillingAddressAction
     */
    public static function ofAddressKey($addressKey, $context = null)
    {
        return static::of($context)->setAddressKey($addressKey);
    }
}
