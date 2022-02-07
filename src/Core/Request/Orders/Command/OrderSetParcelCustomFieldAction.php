<?php

namespace Commercetools\Core\Request\Orders\Command;

use Commercetools\Core\Model\Common\Context;
use Commercetools\Core\Request\CustomField\Command\SetCustomFieldAction;

/**
 * @package Commercetools\Core\Request\Orders\Command
 *
 * @method string getAction()
 * @method OrderSetParcelCustomFieldAction setAction(string $action = null)
 * @method string getName()
 * @method OrderSetParcelCustomFieldAction setName(string $name = null)
 * @method string getParcelId()
 * @method OrderSetParcelCustomFieldAction setParcelId(string $parcelId = null)
 * @method mixed getValue()
 * @method OrderSetParcelCustomFieldAction setValue($value = null)
 */
class OrderSetParcelCustomFieldAction extends SetCustomFieldAction
{
    public function fieldDefinitions()
    {
        return [
            'action' => [static::TYPE => 'string'],
            'name' => [static::TYPE => 'string'],
            'parcelId' => [static::TYPE => 'string'],
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
        $this->setAction('setParcelCustomField');
    }

    /**
     * @param string $parcelId
     * @param string $name
     * @param Context|callable $context
     * @return static
     */
    public static function ofParcelIdAndName($parcelId, $name, $context = null)
    {
        return static::of($context)->setParcelId($parcelId)->setName($name);
    }
}
