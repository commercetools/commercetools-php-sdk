<?php

namespace Commercetools\Core\Request\Types\Command;

use Commercetools\Core\Model\Common\Context;
use Commercetools\Core\Model\Common\Enum;
use Commercetools\Core\Request\AbstractAction;

/**
 * @package Commercetools\Core\Request\Types\Command
 * @link https://docs.commercetools.com/http-api-projects-types#change-enumvalue-label
 * @method string getAction()
 * @method TypeChangeEnumValueLabelAction setAction(string $action = null)
 * @method string getFieldName()
 * @method TypeChangeEnumValueLabelAction setFieldName(string $fieldName = null)
 * @method Enum getValue()
 * @method TypeChangeEnumValueLabelAction setValue(Enum $value = null)
 */
class TypeChangeEnumValueLabelAction extends AbstractAction
{
    public function fieldDefinitions()
    {
        return [
            'action' => [static::TYPE => 'string'],
            'fieldName' => [static::TYPE => 'string'],
            'value' => [static::TYPE => Enum::class]
        ];
    }

    /**
     * @param array $data
     * @param Context|callable $context
     */
    public function __construct(array $data = [], $context = null)
    {
        parent::__construct($data, $context);
        $this->setAction('changeEnumValueLabel');
    }

    /**
     * @param string $fieldName
     * @param Enum $enum
     * @param Context|callable $context
     * @return TypeChangeEnumValueLabelAction
     */
    public static function ofNameAndEnum($fieldName, Enum $enum, $context = null)
    {
        return static::of($context)->setFieldName($fieldName)->setValue($enum);
    }
}
