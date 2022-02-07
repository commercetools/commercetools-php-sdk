<?php

namespace Commercetools\Core\Request\Payments\Command;

use Commercetools\Core\Model\Common\Context;
use Commercetools\Core\Model\CustomField\FieldContainer;
use Commercetools\Core\Model\Type\TypeReference;
use Commercetools\Core\Request\CustomField\Command\SetCustomTypeAction;

/**
 * @package Commercetools\Core\Request\Payments\Command
 *
 * @method string getAction()
 * @method PaymentSetTransactionCustomTypeAction setAction(string $action = null)
 * @method TypeReference getType()
 * @method PaymentSetTransactionCustomTypeAction setType(TypeReference $type = null)
 * @method FieldContainer getFields()
 * @method PaymentSetTransactionCustomTypeAction setFields(FieldContainer $fields = null)
 * @method string getTransactionId()
 * @method PaymentSetTransactionCustomTypeAction setTransactionId(string $transactionId = null)
 */
class PaymentSetTransactionCustomTypeAction extends SetCustomTypeAction
{
    public function fieldDefinitions()
    {
        return [
            'action' => [static::TYPE => 'string'],
            'type' => [static::TYPE => TypeReference::class],
            'transactionId' => [static::TYPE => 'string'],
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
        $this->setAction('setTransactionCustomType');
    }

    /**
     * @param string $typeKey
     * @param string $transactionId
     * @param Context|callable $context
     * @return static
     */
    public static function ofTypeKeyAndTransactionId($typeKey, $transactionId, $context = null)
    {
        return static::ofTypeKey($typeKey, $context)->setTransactionId($transactionId);
    }


    /**
     * @param string $typeId
     * @param string $transactionId
     * @param Context|callable $context
     * @return static
     */
    public static function ofTypeIdAndTransactionId($typeId, $transactionId, $context = null)
    {
        return static::ofTypeId($typeId, $context)->setTransactionId($transactionId);
    }

    /**
     * @param TypeReference $type
     * @param string $transactionId
     * @param Context|callable $context
     * @return static
     */
    public static function ofTypeAndTransactionId(TypeReference $type, $transactionId, $context = null)
    {
        return static::ofType($type, $context)->setTransactionId($transactionId);
    }
}
