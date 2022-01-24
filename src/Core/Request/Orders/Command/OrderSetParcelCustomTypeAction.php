<?php

namespace Commercetools\Core\Request\Orders\Command;

use Commercetools\Core\Model\Common\Context;
use Commercetools\Core\Model\Type\TypeReference;
use Commercetools\Core\Model\CustomField\FieldContainer;
use Commercetools\Core\Request\CustomField\Command\SetCustomTypeAction;

/**
 * @package Commercetools\Core\Request\Orders\Command
 *
 * @method string getAction()
 * @method OrderSetParcelCustomTypeAction setAction(string $action = null)
 * @method TypeReference getType()
 * @method OrderSetParcelCustomTypeAction setType(TypeReference $type = null)
 * @method string getParcelId()
 * @method OrderSetParcelCustomTypeAction setParcelId(string $parcelId = null)
 * @method FieldContainer getFields()
 * @method OrderSetParcelCustomTypeAction setFields(FieldContainer $fields = null)
 */
class OrderSetParcelCustomTypeAction extends SetCustomTypeAction
{
    public function fieldDefinitions()
    {
        return [
            'action' => [static::TYPE => 'string'],
            'type' => [static::TYPE => TypeReference::class],
            'parcelId' => [static::TYPE => 'string'],
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
        $this->setAction('setParcelCustomType');
    }
}
