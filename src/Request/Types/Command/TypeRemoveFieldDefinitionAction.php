<?php
/**
 * @author @ct-jensschulze <jens.schulze@commercetools.de>
 */

namespace Commercetools\Core\Request\Types\Command;

use Commercetools\Core\Model\Common\Context;
use Commercetools\Core\Model\Type\FieldDefinition;
use Commercetools\Core\Request\AbstractAction;
use Commercetools\Core\Model\Common\LocalizedString;

/**
 * @package Commercetools\Core\Request\Types\Command
 * @method string getAction()
 * @method TypeRemoveFieldDefinitionAction setAction(string $action = null)
 * @method string getFieldName()
 * @method TypeRemoveFieldDefinitionAction setFieldName(string $fieldName = null)
 */
class TypeRemoveFieldDefinitionAction extends AbstractAction
{
    public function fieldDefinitions()
    {
        return [
            'action' => [static::TYPE => 'string'],
            'fieldName' => [static::TYPE => 'string'],
        ];
    }

    /**
     * @param array $data
     * @param Context|callable $context
     */
    public function __construct(array $data = [], $context = null)
    {
        parent::__construct($data, $context);
        $this->setAction('removeFieldDefinition');
    }

    /**
     * @param string $fieldName
     * @param Context|callable $context
     * @return TypeRemoveFieldDefinitionAction
     */
    public static function ofFieldName($fieldName, $context = null)
    {
        return static::of($context)->setFieldName($fieldName);
    }
}
