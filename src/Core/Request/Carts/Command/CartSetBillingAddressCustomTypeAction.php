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
 * @method CartSetBillingAddressCustomTypeAction setAction(string $action = null)
 * @method TypeReference getType()
 * @method CartSetBillingAddressCustomTypeAction setType(TypeReference $type = null)
 * @method FieldContainer getFields()
 * @method CartSetBillingAddressCustomTypeAction setFields(FieldContainer $fields = null)
 */
class CartSetBillingAddressCustomTypeAction extends SetCustomTypeAction
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
        $this->setAction('setBillingAddressCustomType');
    }
}
