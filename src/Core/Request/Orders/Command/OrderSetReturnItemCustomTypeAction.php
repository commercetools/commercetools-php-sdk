<?php

namespace Commercetools\Core\Request\Orders\Command;

use Commercetools\Core\Model\Common\Context;
use Commercetools\Core\Model\Type\TypeReference;
use Commercetools\Core\Model\CustomField\FieldContainer;
use Commercetools\Core\Request\CustomField\Command\SetCustomTypeAction;

/**
 * @package Commercetools\Core\Request\Orders\Command
 *
 * @method string getAction()
 * @method OrderSetReturnItemCustomTypeAction setAction(string $action = null)
 * @method TypeReference getType()
 * @method OrderSetReturnItemCustomTypeAction setType(TypeReference $type = null)
 * @method string getReturnItemId()
 * @method OrderSetReturnItemCustomTypeAction setReturnItemId(string $returnItemId = null)
 * @method FieldContainer getFields()
 * @method OrderSetReturnItemCustomTypeAction setFields(FieldContainer $fields = null)
 */
class OrderSetReturnItemCustomTypeAction extends SetCustomTypeAction
{
    public function fieldDefinitions()
    {
        return [
            'action' => [static::TYPE => 'string'],
            'type' => [static::TYPE => TypeReference::class],
            'returnItemId' => [static::TYPE => 'string'],
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
        $this->setAction('setReturnItemCustomType');
    }
}
