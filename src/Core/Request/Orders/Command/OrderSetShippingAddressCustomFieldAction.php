<?php

namespace Commercetools\Core\Request\Orders\Command;

use Commercetools\Core\Model\Common\Context;
use Commercetools\Core\Request\CustomField\Command\SetCustomFieldAction;

/**
 * @package Commercetools\Core\Request\Orders\Command
 *
 * @method string getAction()
 * @method OrderSetShippingAddressCustomFieldAction setAction(string $action = null)
 * @method string getName()
 * @method OrderSetShippingAddressCustomFieldAction setName(string $name = null)
 * @method mixed getValue()
 * @method OrderSetShippingAddressCustomFieldAction setValue($value = null)
 */
class OrderSetShippingAddressCustomFieldAction extends SetCustomFieldAction
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
