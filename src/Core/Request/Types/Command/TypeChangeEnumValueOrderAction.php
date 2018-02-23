<?php
/**
 * @author @jenschude <jens.schulze@commercetools.de>
 */

namespace Commercetools\Core\Request\Types\Command;

use Commercetools\Core\Model\Common\Context;
use Commercetools\Core\Model\Common\EnumCollection;
use Commercetools\Core\Request\AbstractAction;

/**
 * @package Commercetools\Core\Request\Types\Command
 * @link https://docs.commercetools.com/http-api-projects-types.html#change-the-order-of-enumvalues
 * @method string getAction()
 * @method TypeChangeEnumValueOrderAction setAction(string $action = null)
 * @method string getFieldName()
 * @method TypeChangeEnumValueOrderAction setFieldName(string $fieldName = null)
 * @method array getKeys()
 * @method TypeChangeEnumValueOrderAction setKeys(array $keys = null)
 */
class TypeChangeEnumValueOrderAction extends AbstractAction
{
    public function fieldDefinitions()
    {
        return [
            'action' => [static::TYPE => 'string'],
            'fieldName' => [static::TYPE => 'string'],
            'keys' => [static::TYPE => 'array']
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
     * @param string $fieldName
     * @param array $keys
     * @param Context|callable $context
     * @return TypeChangeEnumValueOrderAction
     */
    public static function ofNameAndEnums($fieldName, array $keys, $context = null)
    {
        return static::of($context)->setFieldName($fieldName)->setKeys($keys);
    }
}
