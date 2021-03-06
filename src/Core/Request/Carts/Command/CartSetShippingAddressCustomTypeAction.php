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
 * @method CartSetShippingAddressCustomTypeAction setAction(string $action = null)
 * @method TypeReference getType()
 * @method CartSetShippingAddressCustomTypeAction setType(TypeReference $type = null)
 * @method FieldContainer getFields()
 * @method CartSetShippingAddressCustomTypeAction setFields(FieldContainer $fields = null)
 */
class CartSetShippingAddressCustomTypeAction extends SetCustomTypeAction
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
        $this->setAction('setShippingAddressCustomType');
    }
}
