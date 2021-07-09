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
 * @method OrderSetDeliveryAddressCustomTypeAction setAction(string $action = null)
 * @method TypeReference getType()
 * @method OrderSetDeliveryAddressCustomTypeAction setType(TypeReference $type = null)
 * @method FieldContainer getFields()
 * @method OrderSetDeliveryAddressCustomTypeAction setFields(FieldContainer $fields = null)
 * @method string getDeliveryId()
 * @method OrderSetDeliveryAddressCustomTypeAction setDeliveryId(string $deliveryId = null)
 */
class OrderSetDeliveryAddressCustomTypeAction extends SetCustomTypeAction
{
    public function fieldDefinitions()
    {
        return [
            'action' => [static::TYPE => 'string'],
            'deliveryId' => [static::TYPE => 'string'],
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
        $this->setAction('setDeliveryAddressCustomType');
    }

    public static function ofTypeKeyAndDeliveryId($typeKey, $deliveryId, $context = null)
    {
        return static::of($context)->setType(TypeReference::ofKey($typeKey))->setDeliveryId($deliveryId);
    }

    public static function ofDeliveryId($deliveryId, $context = null)
    {
        return static::of($context)->setDeliveryId($deliveryId);
    }
}
