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
 * @link https://dev.commercetools.com/http-api-projects-types.html#change-the-order-of-localizedenumvalues
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
     * @param string $fieldName
     * @param array $keys
     * @param Context|callable $context
     * @return TypeChangeLocalizedEnumValueOrderAction
     */
    public static function ofNameAndEnums($fieldName, array $keys, $context = null)
    {
        return static::of($context)->setFieldName($fieldName)->setKeys($keys);
    }
}
