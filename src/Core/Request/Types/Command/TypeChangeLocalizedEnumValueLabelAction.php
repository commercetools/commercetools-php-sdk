<?php

namespace Commercetools\Core\Request\Types\Command;

use Commercetools\Core\Model\Common\Context;
use Commercetools\Core\Model\Common\LocalizedEnum;
use Commercetools\Core\Request\AbstractAction;

/**
 * @package Commercetools\Core\Request\Types\Command
 * @link https://docs.commercetools.com/http-api-projects-types#change-localizedenumvalue-label
 * @method string getAction()
 * @method TypeChangeLocalizedEnumValueLabelAction setAction(string $action = null)
 * @method string getFieldName()
 * @method TypeChangeLocalizedEnumValueLabelAction setFieldName(string $fieldName = null)
 * @method LocalizedEnum getValue()
 * @method TypeChangeLocalizedEnumValueLabelAction setValue(LocalizedEnum $value = null)
 */
class TypeChangeLocalizedEnumValueLabelAction extends AbstractAction
{
    public function fieldDefinitions()
    {
        return [
            'action' => [static::TYPE => 'string'],
            'fieldName' => [static::TYPE => 'string'],
            'value' => [static::TYPE => LocalizedEnum::class]
        ];
    }

    /**
     * @param array $data
     * @param Context|callable $context
     */
    public function __construct(array $data = [], $context = null)
    {
        parent::__construct($data, $context);
        $this->setAction('changeLocalizedEnumValueLabel');
    }

    /**
     * @param string $fieldName
     * @param LocalizedEnum $enum
     * @param Context|callable $context
     * @return TypeChangeLocalizedEnumValueLabelAction
     */
    public static function ofNameAndEnum($fieldName, LocalizedEnum $enum, $context = null)
    {
        return static::of($context)->setFieldName($fieldName)->setValue($enum);
    }
}
