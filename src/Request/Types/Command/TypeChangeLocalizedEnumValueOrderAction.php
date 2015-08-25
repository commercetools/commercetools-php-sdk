<?php
/**
 * @author @ct-jensschulze <jens.schulze@commercetools.de>
 */

namespace Commercetools\Core\Request\Types\Command;

use Commercetools\Core\Model\Common\Context;
use Commercetools\Core\Model\Common\EnumCollection;
use Commercetools\Core\Model\Common\LocalizedEnumCollection;
use Commercetools\Core\Request\AbstractAction;

/**
 * @package Commercetools\Core\Request\Types\Command
 *
 * @method string getAction()
 * @method TypeChangeLocalizedEnumValueOrderAction setAction(string $action = null)
 * @method string getFieldName()
 * @method TypeChangeLocalizedEnumValueOrderAction setFieldName(string $fieldName = null)
 * @method LocalizedEnumCollection getValues()
 * @method TypeChangeLocalizedEnumValueOrderAction setValues(LocalizedEnumCollection $values = null)
 */
class TypeChangeLocalizedEnumValueOrderAction extends AbstractAction
{
    public function fieldDefinitions()
    {
        return [
            'action' => [static::TYPE => 'string'],
            'fieldName' => [static::TYPE => 'string'],
            'values' => [static::TYPE => '\Commercetools\Core\Model\Common\LocalizedEnumCollection']
        ];
    }

    /**
     * @param array $data
     * @param Context|callable $context
     */
    public function __construct(array $data = [], $context = null)
    {
        parent::__construct($data, $context);
        $this->setAction('changeLocalizedEnumValueOrder');
    }

    /**
     * @param LocalizedEnumCollection $enums
     * @param Context|callable $context
     * @return TypeChangeLocalizedEnumValueOrderAction
     */
    public static function ofEnums(LocalizedEnumCollection $enums, $context = null)
    {
        return static::of($context)->setValues($enums);
    }
}
