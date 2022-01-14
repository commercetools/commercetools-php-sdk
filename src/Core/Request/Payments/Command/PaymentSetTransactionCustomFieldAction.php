<?php

namespace Commercetools\Core\Request\Payments\Command;

use Commercetools\Core\Model\Common\Context;
use Commercetools\Core\Request\CustomField\Command\SetCustomFieldAction;

/**
 * @package Commercetools\Core\Request\Payments\Command
 *
 * @method string getAction()
 * @method PaymentSetTransactionCustomFieldAction setAction(string $action = null)
 * @method string getTransactionId()
 * @method PaymentSetTransactionCustomFieldAction setTransactionId(string $transactionId = null)
 * @method string getName()
 * @method PaymentSetTransactionCustomFieldAction setName(string $name = null)
 * @method mixed getValue()
 * @method PaymentSetTransactionCustomFieldAction setValue($value = null)
 */
class PaymentSetTransactionCustomFieldAction extends SetCustomFieldAction
{
    public function fieldDefinitions()
    {
        return [
            'action' => [static::TYPE => 'string'],
            'name' => [static::TYPE => 'string'],
            'transactionId' => [static::TYPE => 'string'],
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
        $this->setAction('setTransactionCustomField');
    }

    /**
     * @param string $transactionId
     * @param string $name
     * @param Context|callable $context
     * @return static
     */
    public static function ofTransactionIdAndName($transactionId, $name, $context = null)
    {
        return static::of($context)->setTransactionId($transactionId)->setName($name);
    }
}
