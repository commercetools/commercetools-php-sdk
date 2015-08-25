<?php
/**
 * @author @ct-jensschulze <jens.schulze@commercetools.de>
 */

namespace Commercetools\Core\Request\Types\Command;

use Commercetools\Core\Model\Common\Context;
use Commercetools\Core\Model\Type\FieldDefinitionCollection;
use Commercetools\Core\Request\AbstractAction;

/**
 * @package Commercetools\Core\Request\Types\Command
 *
 * @method string getAction()
 * @method TypeChangeFieldDefinitionOrderAction setAction(string $action = null)
 * @method FieldDefinitionCollection getAttributes()
 * @method TypeChangeFieldDefinitionOrderAction setAttributes(FieldDefinitionCollection $attributes = null)
 */
class TypeChangeFieldDefinitionOrderAction extends AbstractAction
{
    public function fieldDefinitions()
    {
        return [
            'action' => [static::TYPE => 'string'],
            'attributes' => [static::TYPE => '\Commercetools\Core\Model\Type\FieldDefinitionCollection'],
        ];
    }

    /**
     * @param array $data
     * @param Context|callable $context
     */
    public function __construct(array $data = [], $context = null)
    {
        parent::__construct($data, $context);
        $this->setAction('changeFieldDefinitionOrder');
    }

    /**
     * @param FieldDefinitionCollection $fieldDefinitions
     * @param Context|callable $context
     * @return TypeChangeFieldDefinitionOrderAction
     */
    public static function ofFieldDefinitions(FieldDefinitionCollection $fieldDefinitions, $context = null)
    {
        return static::of($context)->setAttributes($fieldDefinitions);
    }
}
