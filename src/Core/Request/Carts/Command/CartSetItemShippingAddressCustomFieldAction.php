<?php

namespace Commercetools\Core\Request\Carts\Command;

use Commercetools\Core\Model\Common\Context;
use Commercetools\Core\Request\CustomField\Command\SetCustomFieldAction;

/**
 * @package Commercetools\Core\Request\Carts\Command
 *
 * @method string getAction()
 * @method CartSetItemShippingAddressCustomFieldAction setAction(string $action = null)
 * @method string getName()
 * @method CartSetItemShippingAddressCustomFieldAction setName(string $name = null)
 * @method mixed getValue()
 * @method CartSetItemShippingAddressCustomFieldAction setValue($value = null)
 * @method string getAddressKey()
 * @method CartSetItemShippingAddressCustomFieldAction setAddressKey(string $addressKey = null)
 */
class CartSetItemShippingAddressCustomFieldAction extends SetCustomFieldAction
{
    public function fieldDefinitions()
    {
        return [
            'action' => [static::TYPE => 'string'],
            'addressKey' => [static::TYPE => 'string'],
            'name' => [static::TYPE => 'string'],
            'value' => [static::TYPE => null],
        ];
    }

    /**
     * @param array $data
     * @param Context|callable $context
     */
    public function __construct(array $data = [], $context = null)
    {
        parent::__construct($data, $context);
        $this->setAction('setItemShippingAddressCustomField');
    }

    public static function ofNameAndAddressKey($name, $addressKey, $context = null)
    {
        return static::of($context)->setName($name)->setAddressKey($addressKey);
    }

    public static function ofAddressKey($addressKey, $context = null)
    {
        return static::of($context)->setAddressKey($addressKey);
    }
}
