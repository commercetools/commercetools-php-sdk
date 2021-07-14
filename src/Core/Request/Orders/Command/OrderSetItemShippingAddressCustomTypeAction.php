<?php

namespace Commercetools\Core\Request\Orders\Command;

use Commercetools\Core\Model\Common\Context;
use Commercetools\Core\Model\CustomField\FieldContainer;
use Commercetools\Core\Model\Type\TypeReference;
use Commercetools\Core\Request\CustomField\Command\SetCustomTypeAction;

/**
 * @package Commercetools\Core\Request\Orders\Command
 *
 * @method string getAction()
 * @method OrderSetItemShippingAddressCustomTypeAction setAction(string $action = null)
 * @method TypeReference getType()
 * @method OrderSetItemShippingAddressCustomTypeAction setType(TypeReference $type = null)
 * @method FieldContainer getFields()
 * @method OrderSetItemShippingAddressCustomTypeAction setFields(FieldContainer $fields = null)
 * @method string getAddressKey()
 * @method OrderSetItemShippingAddressCustomTypeAction setAddressKey(string $addressKey = null)
 */
class OrderSetItemShippingAddressCustomTypeAction extends SetCustomTypeAction
{
    public function fieldDefinitions()
    {
        return [
            'action' => [static::TYPE => 'string'],
            'addressKey' => [static::TYPE => 'string'],
            'type' => [static::TYPE => TypeReference::class],
            'fields' => [static::TYPE => FieldContainer::class],
        ];
    }

    /**
     * @param array $data
     * @param Context|callable $context
     */
    public function __construct(array $data = [], $context = null)
    {
        parent::__construct($data, $context);
        $this->setAction('setItemShippingAddressCustomType');
    }

    public static function ofTypeKeyAndAddressKey($typeKey, $addressKey, $context = null)
    {
        return static::of($context)->setType(TypeReference::ofKey($typeKey))->setAddressKey($addressKey);
    }

    public static function ofAddressKey($addressKey, $context = null)
    {
        return static::of($context)->setAddressKey($addressKey);
    }
}
