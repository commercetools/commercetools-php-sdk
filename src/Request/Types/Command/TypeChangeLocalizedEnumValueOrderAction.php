<?php
/**
 * @author @jayS-de <jens.schulze@commercetools.de>
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
 * @method array getKeys()
 * @method TypeChangeLocalizedEnumValueOrderAction setKeys(array $keys = null)
 */
class TypeChangeLocalizedEnumValueOrderAction extends AbstractAction
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
        $this->setAction('changeLocalizedEnumValueOrder');
    }

    /**
     * @param array $keys
     * @param Context|callable $context
     * @return TypeChangeLocalizedEnumValueOrderAction
     */
    public static function ofEnums(array $keys, $context = null)
    {
        return static::of($context)->setKeys($keys);
    }
}
