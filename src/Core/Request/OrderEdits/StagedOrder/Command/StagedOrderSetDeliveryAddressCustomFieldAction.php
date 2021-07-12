<?php

namespace Commercetools\Core\Request\OrderEdits\StagedOrder\Command;

use Commercetools\Core\Model\Common\Context;
use Commercetools\Core\Request\Orders\Command\OrderSetDeliveryAddressCustomFieldAction;

/**
 * @package Commercetools\Core\Request\OrderEdits\StagedOrder\Command
 *
 *
 * @method string getAction()
 * @method StagedOrderSetDeliveryAddressCustomFieldAction setAction(string $action = null)
 * @method string getName()
 * @method StagedOrderSetDeliveryAddressCustomFieldAction setName(string $name = null)
 * @method mixed getValue()
 * @method StagedOrderSetDeliveryAddressCustomFieldAction setValue($value = null)
 * @method string getDeliveryId()
 * @method StagedOrderSetDeliveryAddressCustomFieldAction setDeliveryId(string $deliveryId = null)
 */
// phpcs:ignore
class StagedOrderSetDeliveryAddressCustomFieldAction extends OrderSetDeliveryAddressCustomFieldAction implements StagedOrderUpdateAction
{
    public function fieldDefinitions()
    {
        return [
            'action' => [static::TYPE => 'string'],
            'deliveryId' => [static::TYPE => 'string'],
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
        $this->setAction('setDeliveryAddressCustomField');
    }

    public static function ofNameAndDeliveryId($name, $addressKey, $context = null)
    {
        return static::of($context)->setName($name)->setDeliveryId($addressKey);
    }

    public static function ofDeliveryId($addressKey, $context = null)
    {
        return static::of($context)->setDeliveryId($addressKey);
    }
}
