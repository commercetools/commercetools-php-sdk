<?php

namespace Commercetools\Core\Request\Orders\Command;

use Commercetools\Core\Model\Common\Context;
use Commercetools\Core\Request\CustomField\Command\SetCustomFieldAction;

/**
 * @package Commercetools\Core\Request\Orders\Command
 *
 *
 * @method string getAction()
 * @method OrderSetDeliveryAddressCustomFieldAction setAction(string $action = null)
 * @method string getName()
 * @method OrderSetDeliveryAddressCustomFieldAction setName(string $name = null)
 * @method mixed getValue()
 * @method OrderSetDeliveryAddressCustomFieldAction setValue($value = null)
 * @method string getDeliveryId()
 * @method OrderSetDeliveryAddressCustomFieldAction setDeliveryId(string $deliveryId = null)
 */
class OrderSetDeliveryAddressCustomFieldAction extends SetCustomFieldAction
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
