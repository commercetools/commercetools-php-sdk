<?php
/**
 * @author @ct-jensschulze <jens.schulze@commercetools.de>
 */

namespace Commercetools\Core\Request\Types\Command;

use Commercetools\Core\Model\Common\Context;
use Commercetools\Core\Model\Common\EnumCollection;
use Commercetools\Core\Request\AbstractAction;

/**
 * @package Commercetools\Core\Request\Types\Command
 *
 * @method string getAction()
 * @method TypeChangeEnumValueOrderAction setAction(string $action = null)
 * @method string getFieldName()
 * @method TypeChangeEnumValueOrderAction setFieldName(string $fieldName = null)
 * @method EnumCollection getValues()
 * @method TypeChangeEnumValueOrderAction setValues(EnumCollection $values = null)
 */
class TypeChangeEnumValueOrderAction extends AbstractAction
{
    public function fieldDefinitions()
    {
        return [
            'action' => [static::TYPE => 'string'],
            'fieldName' => [static::TYPE => 'string'],
            'values' => [static::TYPE => '\Commercetools\Core\Model\Common\EnumCollection']
        ];
    }

    /**
     * @param array $data
     * @param Context|callable $context
     */
    public function __construct(array $data = [], $context = null)
    {
        parent::__construct($data, $context);
        $this->setAction('changeEnumValueOrder');
    }

    /**
     * @param EnumCollection $enums
     * @param Context|callable $context
     * @return TypeChangeEnumValueOrderAction
     */
    public static function ofEnums(EnumCollection $enums, $context = null)
    {
        return static::of($context)->setValues($enums);
    }
}
