<?php
/**
 * @author @jenschude <jens.schulze@commercetools.de>
 */

namespace Commercetools\Core\Request\Customers\Command;

use Commercetools\Core\Model\Common\Context;
use Commercetools\Core\Request\AbstractAction;

/**
 * @package Commercetools\Core\Request\Customers\Command
 * @link https://docs.commercetools.com/http-api-projects-customers.html#remove-address
 * @method string getAddressId()
 * @method CustomerRemoveAddressAction setAddressId(string $addressId = null)
 * @method string getAction()
 * @method CustomerRemoveAddressAction setAction(string $action = null)
 * @method string getAddressKey()
 * @method CustomerRemoveAddressAction setAddressKey(string $addressKey = null)
 */
class CustomerRemoveAddressAction extends AbstractAction
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
        $this->setAction('removeAddress');
    }

    /**
     * @param $addressId
     * @param Context|callable $context
     * @return CustomerRemoveAddressAction
     */
    public static function ofAddressId($addressId, $context = null)
    {
        return static::of($context)->setAddressId($addressId);
    }

    /**
     * @param $addressKey
     * @param Context|callable $context
     * @return CustomerRemoveAddressAction
     */
    public static function ofAddressKey($addressKey, $context = null)
    {
        return static::of($context)->setAddressKey($addressKey);
    }
}
