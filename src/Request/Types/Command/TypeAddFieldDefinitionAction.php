<?php
/**
 * @author @jayS-de <jens.schulze@commercetools.de>
 */

namespace Commercetools\Core\Request\Types\Command;

use Commercetools\Core\Model\Common\Context;
use Commercetools\Core\Model\Type\FieldDefinition;
use Commercetools\Core\Request\AbstractAction;
use Commercetools\Core\Model\Common\LocalizedString;

/**
 * @package Commercetools\Core\Request\Types\Command
 * @method string getAction()
 * @method TypeAddFieldDefinitionAction setAction(string $action = null)
 * @method FieldDefinition getFieldDefinition()
 * @method TypeAddFieldDefinitionAction setFieldDefinition(FieldDefinition $fieldDefinition = null)
 */
class TypeAddFieldDefinitionAction extends AbstractAction
{
    public function fieldDefinitions()
    {
        return [
            'action' => [static::TYPE => 'string'],
            'fieldDefinition' => [static::TYPE => '\Commercetools\Core\Model\Type\FieldDefinition'],
        ];
    }

    /**
     * @param array $data
     * @param Context|callable $context
     */
    public function __construct(array $data = [], $context = null)
    {
        parent::__construct($data, $context);
        $this->setAction('addFieldDefinition');
    }

    /**
     * @param FieldDefinition $fieldDefinition
     * @param Context|callable $context
     * @return TypeAddFieldDefinitionAction
     */
    public static function ofFieldDefinition(FieldDefinition $fieldDefinition, $context = null)
    {
        return static::of($context)->setFieldDefinition($fieldDefinition);
    }
}
