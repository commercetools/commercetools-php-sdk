<?php

namespace Commercetools\Core\Request\Orders\Command;

use Commercetools\Core\Model\Common\Context;
use Commercetools\Core\Request\CustomField\Command\SetCustomFieldAction;

/**
 * @package Commercetools\Core\Request\Orders\Command
 *
 * @method string getAction()
 * @method OrderSetItemShippingAddressCustomFieldAction setAction(string $action = null)
 * @method string getName()
 * @method OrderSetItemShippingAddressCustomFieldAction setName(string $name = null)
 * @method mixed getValue()
 * @method OrderSetItemShippingAddressCustomFieldAction setValue($value = null)
 * @method string getAddressKey()
 * @method OrderSetItemShippingAddressCustomFieldAction setAddressKey(string $addressKey = null)
 */
class OrderSetItemShippingAddressCustomFieldAction extends SetCustomFieldAction
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
