<?php

namespace Commercetools\Core\Request\Customers\Command;

use Commercetools\Core\Model\Common\Context;
use Commercetools\Core\Request\CustomField\Command\SetCustomFieldAction;

/**
 * @package Commercetools\Core\Request\Customers\Command
 *
 * @method string getAction()
 * @method CustomerSetAddressCustomFieldAction setAction(string $action = null)
 * @method string getName()
 * @method CustomerSetAddressCustomFieldAction setName(string $name = null)
 * @method mixed getValue()
 * @method CustomerSetAddressCustomFieldAction setValue($value = null)
 * @method string getAddressId()
 * @method CustomerSetAddressCustomFieldAction setAddressId(string $addressId = null)
 */
class CustomerSetAddressCustomFieldAction extends SetCustomFieldAction
{
    public function fieldDefinitions()
    {
        return [
            'action' => [static::TYPE => 'string'],
            'name' => [static::TYPE => 'string'],
            'value' => [static::TYPE => null],
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
        $this->setAction('setAddressCustomField');
    }

    /**
     * @param string $addressId
     * @param Context|callable $context
     * @return CustomerSetAddressCustomFieldAction
     */
    public static function ofAddressId($addressId, $context = null)
    {
        return static::of($context)->setAddressId($addressId);
    }
}
