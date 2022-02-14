<?php

namespace Commercetools\Core\Request\Orders\Command;

use Commercetools\Core\Model\Common\Context;
use Commercetools\Core\Request\CustomField\Command\SetCustomFieldAction;

/**
 * @package Commercetools\Core\Request\Orders\Command
 *
 *
 * @method string getAction()
 * @method OrderSetDeliveryCustomFieldAction setAction(string $action = null)
 * @method string getName()
 * @method OrderSetDeliveryCustomFieldAction setName(string $name = null)
 * @method mixed getValue()
 * @method OrderSetDeliveryCustomFieldAction setValue($value = null)
 */
class OrderSetDeliveryCustomFieldAction extends SetCustomFieldAction
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
        $this->setAction('setDeliveryCustomField');
    }

    public static function ofName($name, $context = null)
    {
        return static::of($context)->setName($name);
    }
}
