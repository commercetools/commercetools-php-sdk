<?php

namespace Commercetools\Core\Request\Channels\Command;

use Commercetools\Core\Model\Common\Context;
use Commercetools\Core\Request\CustomField\Command\SetCustomFieldAction;

/**
 * @package Commercetools\Core\Request\Channels\Command
 *
 * @method string getAction()
 * @method ChannelSetAddressCustomFieldAction setAction(string $action = null)
 * @method string getName()
 * @method ChannelSetAddressCustomFieldAction setName(string $name = null)
 * @method mixed getValue()
 * @method ChannelSetAddressCustomFieldAction setValue($value = null)
 * @method string getAddressId()
 * @method ChannelSetAddressCustomFieldAction setAddressId(string $addressId = null)
 */
class ChannelSetAddressCustomFieldAction extends SetCustomFieldAction
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
        $this->setAction('setAddressCustomField');
    }
}
