<?php
/**
 * @author @jenschude <jens.schulze@commercetools.de>
 */

namespace Commercetools\Core\Request\Types\Command;

use Commercetools\Core\Model\Common\Context;
use Commercetools\Core\Model\Common\LocalizedEnum;
use Commercetools\Core\Request\AbstractAction;

/**
 * @package Commercetools\Core\Request\Types\Command
 * @link https://docs.commercetools.com/http-api-projects-types.html#add-localizedenumvalue-to-fielddefinition
 * @method string getAction()
 * @method TypeAddLocalizedEnumValueAction setAction(string $action = null)
 * @method string getFieldName()
 * @method TypeAddLocalizedEnumValueAction setFieldName(string $fieldName = null)
 * @method LocalizedEnum getValue()
 * @method TypeAddLocalizedEnumValueAction setValue(LocalizedEnum $value = null)
 */
class TypeAddLocalizedEnumValueAction extends AbstractAction
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
        $this->setAction('addLocalizedEnumValue');
    }

    /**
     * @param string $fieldName
     * @param LocalizedEnum $enum
     * @param Context|callable $context
     * @return TypeAddLocalizedEnumValueAction
     */
    public static function ofNameAndEnum($fieldName, LocalizedEnum $enum, $context = null)
    {
        return static::of($context)->setFieldName($fieldName)->setValue($enum);
    }
}
