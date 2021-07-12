<?php

namespace Commercetools\Core\Request\OrderEdits\StagedOrder\Command;

use Commercetools\Core\Model\Common\Context;
use Commercetools\Core\Model\CustomField\FieldContainer;
use Commercetools\Core\Model\Type\TypeReference;
use Commercetools\Core\Request\Orders\Command\OrderSetItemShippingAddressCustomTypeAction;

/**
 * @package Commercetools\Core\Request\OrderEdits\StagedOrder\Command
 *
 * @method string getAction()
 * @method StagedOrderSetItemShippingAddressCustomTypeAction setAction(string $action = null)
 * @method TypeReference getType()
 * @method StagedOrderSetItemShippingAddressCustomTypeAction setType(TypeReference $type = null)
 * @method FieldContainer getFields()
 * @method StagedOrderSetItemShippingAddressCustomTypeAction setFields(FieldContainer $fields = null)
 */
// phpcs:ignore
class StagedOrderSetItemShippingAddressCustomTypeAction extends OrderSetItemShippingAddressCustomTypeAction implements StagedOrderUpdateAction
{
    public function fieldDefinitions()
    {
        return [
            'action' => [static::TYPE => 'string'],
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
}
