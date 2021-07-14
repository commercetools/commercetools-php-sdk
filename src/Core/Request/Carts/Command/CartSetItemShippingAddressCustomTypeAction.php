<?php

namespace Commercetools\Core\Request\Carts\Command;

use Commercetools\Core\Model\Common\Context;
use Commercetools\Core\Model\CustomField\FieldContainer;
use Commercetools\Core\Model\Type\TypeReference;
use Commercetools\Core\Request\CustomField\Command\SetCustomTypeAction;

/**
 * @package Commercetools\Core\Request\Carts\Command
 *
 * @method string getAction()
 * @method CartSetItemShippingAddressCustomTypeAction setAction(string $action = null)
 * @method TypeReference getType()
 * @method CartSetItemShippingAddressCustomTypeAction setType(TypeReference $type = null)
 * @method FieldContainer getFields()
 * @method CartSetItemShippingAddressCustomTypeAction setFields(FieldContainer $fields = null)
 * @method string getAddressKey()
 * @method CartSetItemShippingAddressCustomTypeAction setAddressKey(string $addressKey = null)
 */
class CartSetItemShippingAddressCustomTypeAction extends SetCustomTypeAction
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
