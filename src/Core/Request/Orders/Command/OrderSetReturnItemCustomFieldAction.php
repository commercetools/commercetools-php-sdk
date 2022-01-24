<?php

namespace Commercetools\Core\Request\Orders\Command;

use Commercetools\Core\Model\Common\Context;
use Commercetools\Core\Request\CustomField\Command\SetCustomFieldAction;

/**
 * @package Commercetools\Core\Request\Orders\Command
 *
 * @method string getAction()
 * @method OrderSetReturnItemCustomFieldAction setAction(string $action = null)
 * @method string getName()
 * @method OrderSetReturnItemCustomFieldAction setName(string $name = null)
 * @method string getLineItemId()
 * @method OrderSetLineItemCustomFieldAction setLineItemId(string $returnItemId = null)
 * @method mixed getValue()
 * @method OrderSetReturnItemCustomFieldAction setValue($value = null)
 * @method string getReturnItemId()
 * @method OrderSetReturnItemCustomFieldAction setReturnItemId(string $returnItemId = null)
 */
class OrderSetReturnItemCustomFieldAction extends SetCustomFieldAction
{
    public function fieldDefinitions()
    {
        return [
            'action' => [static::TYPE => 'string'],
            'name' => [static::TYPE => 'string'],
            'returnItemId' => [static::TYPE => 'string'],
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
        $this->setAction('setReturnItemCustomField');
    }

    /**
     * @param string $returnItemId
     * @param string $name
     * @param Context|callable $context
     * @return static
     */
    public static function ofReturnItemIdAndName($returnItemId, $name, $context = null)
    {
        return static::of($context)->setReturnItemId($returnItemId)->setName($name);
    }
}
