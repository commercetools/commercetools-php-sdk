<?php

namespace Commercetools\Core\Request\OrderEdits\StagedOrder\Command;

use Commercetools\Core\Model\Common\Context;
use Commercetools\Core\Request\Orders\Command\OrderSetShippingAddressCustomFieldAction;

/**
 * @package Commercetools\Core\Request\OrderEdits\StagedOrder\Command
 *
 * @method string getAction()
 * @method StagedOrderSetShippingAddressCustomFieldAction setAction(string $action = null)
 * @method string getName()
 * @method StagedOrderSetShippingAddressCustomFieldAction setName(string $name = null)
 * @method mixed getValue()
 * @method StagedOrderSetShippingAddressCustomFieldAction setValue($value = null)
 */
// phpcs:ignore
class StagedOrderSetShippingAddressCustomFieldAction extends OrderSetShippingAddressCustomFieldAction implements StagedOrderUpdateAction
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
        $this->setAction('setShippingAddressCustomField');
    }
}
