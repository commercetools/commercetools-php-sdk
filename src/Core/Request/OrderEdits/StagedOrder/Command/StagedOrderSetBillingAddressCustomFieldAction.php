<?php

namespace Commercetools\Core\Request\OrderEdits\StagedOrder\Command;

use Commercetools\Core\Model\Common\Context;
use Commercetools\Core\Request\Orders\Command\OrderSetCustomFieldAction;

/**
 * @package Commercetools\Core\Request\OrderEdits\StagedOrder\Command
 *
 * @method string getAction()
 * @method StagedOrderSetBillingAddressCustomFieldAction setAction(string $action = null)
 * @method string getName()
 * @method StagedOrderSetBillingAddressCustomFieldAction setName(string $name = null)
 * @method mixed getValue()
 * @method StagedOrderSetBillingAddressCustomFieldAction setValue($value = null)
 */
// phpcs:ignore
class StagedOrderSetBillingAddressCustomFieldAction  extends OrderSetCustomFieldAction implements StagedOrderUpdateAction
{
    public function fieldDefinitions()
    {
        return [
            'action' => [static::TYPE => 'string'],
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
        $this->setAction('setBillingAddressCustomField');
    }
}
