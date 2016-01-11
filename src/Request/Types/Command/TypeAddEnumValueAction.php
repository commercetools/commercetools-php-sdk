<?php
/**
 * @author @jayS-de <jens.schulze@commercetools.de>
 */

namespace Commercetools\Core\Request\Types\Command;

use Commercetools\Core\Model\Common\Context;
use Commercetools\Core\Model\Common\Enum;
use Commercetools\Core\Request\AbstractAction;

/**
 * @package Commercetools\Core\Request\Types\Command
 *
 * @method string getAction()
 * @method TypeAddEnumValueAction setAction(string $action = null)
 * @method string getFieldName()
 * @method TypeAddEnumValueAction setFieldName(string $fieldName = null)
 * @method Enum getValue()
 * @method TypeAddEnumValueAction setValue(Enum $value = null)
 */
class TypeAddEnumValueAction extends AbstractAction
{
    public function fieldDefinitions()
    {
        return [
            'action' => [static::TYPE => 'string'],
            'fieldName' => [static::TYPE => 'string'],
            'value' => [static::TYPE => '\Commercetools\Core\Model\Common\Enum']
        ];
    }

    /**
     * @param array $data
     * @param Context|callable $context
     */
    public function __construct(array $data = [], $context = null)
    {
        parent::__construct($data, $context);
        $this->setAction('addEnumValue');
    }

    /**
     * @param Enum $enum
     * @param Context|callable $context
     * @return TypeAddEnumValueAction
     */
    public static function ofEnum(Enum $enum, $context = null)
    {
        return static::of($context)->setValue($enum);
    }
}
