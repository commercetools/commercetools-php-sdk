<?php

namespace Commercetools\Core\Request\Carts\Command;

use Commercetools\Core\Model\Common\Context;
use Commercetools\Core\Request\CustomField\Command\SetCustomFieldAction;

/**
 * @package Commercetools\Core\Request\Carts\Command
 *
 * @method string getAction()
 * @method CartSetBillingAddressCustomFieldAction setAction(string $action = null)
 * @method string getName()
 * @method CartSetBillingAddressCustomFieldAction setName(string $name = null)
 * @method mixed getValue()
 * @method CartSetBillingAddressCustomFieldAction setValue($value = null)
 */
class CartSetBillingAddressCustomFieldAction extends SetCustomFieldAction
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
