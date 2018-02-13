<?php
/**
 * @author @jenschude <jens.schulze@commercetools.de>
 */

namespace Commercetools\Core\Request\Types\Command;

use Commercetools\Core\Model\Common\Context;
use Commercetools\Core\Model\Type\FieldDefinitionCollection;
use Commercetools\Core\Request\AbstractAction;

/**
 * @package Commercetools\Core\Request\Types\Command
 * @link https://docs.commercetools.com/http-api-projects-types.html#change-the-order-of-fielddefinitions
 * @method string getAction()
 * @method TypeChangeFieldDefinitionOrderAction setAction(string $action = null)
 * @method array getFieldNames()
 * @method TypeChangeFieldDefinitionOrderAction setFieldNames(array $fieldNames = null)
 */
class TypeChangeFieldDefinitionOrderAction extends AbstractAction
{
    public function fieldDefinitions()
    {
        return [
            'action' => [static::TYPE => 'string'],
            'fieldNames' => [static::TYPE => 'array'],
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
     * @param array $fieldNames
     * @param Context|callable $context
     * @return TypeChangeFieldDefinitionOrderAction
     */
    public static function ofFieldDefinitions(array $fieldNames, $context = null)
    {
        return static::of($context)->setFieldNames($fieldNames);
    }
}
