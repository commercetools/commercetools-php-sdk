<?php

namespace Commercetools\Core\Request\Customers\Command;

use Commercetools\Core\Model\Common\Context;
use Commercetools\Core\Model\CustomField\FieldContainer;
use Commercetools\Core\Model\Type\TypeReference;
use Commercetools\Core\Request\CustomField\Command\SetCustomTypeAction;

/**
 * @package Commercetools\Core\Request\Customers\Command
 *
 * @method string getAction()
 * @method CustomerSetAddressCustomTypeAction setAction(string $action = null)
 * @method TypeReference getType()
 * @method CustomerSetAddressCustomTypeAction setType(TypeReference $type = null)
 * @method FieldContainer getFields()
 * @method CustomerSetAddressCustomTypeAction setFields(FieldContainer $fields = null)
 * @method string getAddressId()
 * @method CustomerSetAddressCustomTypeAction setAddressId(string $addressId = null)
 */
class CustomerSetAddressCustomTypeAction extends SetCustomTypeAction
{
    public function fieldDefinitions()
    {
        return [
            'action' => [static::TYPE => 'string'],
            'type' => [static::TYPE => TypeReference::class],
            'fields' => [static::TYPE => FieldContainer::class],
            'addressId' => [static::TYPE => 'string']
        ];
    }

    /**
     * @param array $data
     * @param Context|callable $context
     */
    public function __construct(array $data = [], $context = null)
    {
        parent::__construct($data, $context);
        $this->setAction('setAddressCustomType');
    }

    /**
     * @param string $addressId
     * @param Context|callable $context
     * @return CustomerSetAddressCustomTypeAction
     */
    public static function ofAddressId($addressId, $context = null)
    {
        return static::of($context)->setAddressId($addressId);
    }
}
