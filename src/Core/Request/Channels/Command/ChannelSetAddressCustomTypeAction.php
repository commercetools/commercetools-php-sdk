<?php

namespace Commercetools\Core\Request\Channels\Command;

use Commercetools\Core\Model\Common\Context;
use Commercetools\Core\Model\CustomField\FieldContainer;
use Commercetools\Core\Model\Type\TypeReference;
use Commercetools\Core\Request\CustomField\Command\SetCustomTypeAction;

/**
 * @package Commercetools\Core\Request\Channels\Command
 *
 * @method string getAction()
 * @method ChannelSetAddressCustomTypeAction setAction(string $action = null)
 * @method TypeReference getType()
 * @method ChannelSetAddressCustomTypeAction setType(TypeReference $type = null)
 * @method FieldContainer getFields()
 * @method ChannelSetAddressCustomTypeAction setFields(FieldContainer $fields = null)
 * @method string getAddressId()
 * @method ChannelSetAddressCustomTypeAction setAddressId(string $addressId = null)
 */
class ChannelSetAddressCustomTypeAction extends SetCustomTypeAction
{
    public function fieldDefinitions()
    {
        return [
            'action' => [static::TYPE => 'string'],
            'type' => [static::TYPE => TypeReference::class],
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
        $this->setAction('setAddressCustomType');
    }
}
