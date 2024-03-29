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
 * @method OrderSetDeliveryCustomTypeAction setAction(string $action = null)
 * @method TypeReference getType()
 * @method OrderSetDeliveryCustomTypeAction setType(TypeReference $type = null)
 * @method FieldContainer getFields()
 * @method OrderSetDeliveryCustomTypeAction setFields(FieldContainer $fields = null)
 */
class OrderSetDeliveryCustomTypeAction extends SetCustomTypeAction
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
        $this->setAction('setDeliveryCustomType');
    }

    public static function ofTypeKey($typeKey, $context = null)
    {
        return static::of($context)->setType(TypeReference::ofKey($typeKey));
    }
}
