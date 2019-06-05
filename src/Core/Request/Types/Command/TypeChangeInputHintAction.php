<?php

namespace Commercetools\Core\Request\Types\Command;

use Commercetools\Core\Model\Common\Context;
use Commercetools\Core\Model\Common\Enum;
use Commercetools\Core\Request\AbstractAction;

/**
 * @package Commercetools\Core\Request\Types\Command
 * @link https://docs.commercetools.com/http-api-projects-types#change-inputhint
 * @method string getAction()
 * @method TypeChangeInputHintAction setAction(string $action = null)
 * @method string getFieldName()
 * @method TypeChangeInputHintAction setFieldName(string $fieldName = null)
 * @method string getInputHint()
 * @method TypeChangeInputHintAction setInputHint(string $inputHint = null)
 */
class TypeChangeInputHintAction extends AbstractAction
{
    public function fieldDefinitions()
    {
        return [
            'action' => [static::TYPE => 'string'],
            'fieldName' => [static::TYPE => 'string'],
            'inputHint' => [static::TYPE => 'string']
        ];
    }

    /**
     * @param array $data
     * @param Context|callable $context
     */
    public function __construct(array $data = [], $context = null)
    {
        parent::__construct($data, $context);
        $this->setAction('changeInputHint');
    }

    /**
     * @param string $fieldName
     * @param string $inputHint
     * @param Context|callable $context
     * @return TypeChangeInputHintAction
     */
    public static function ofNameAndInputHint($fieldName, $inputHint, $context = null)
    {
        return static::of($context)->setFieldName($fieldName)->setInputHint($inputHint);
    }
}
