<?php
/**
 * @author @ct-jensschulze <jens.schulze@commercetools.de>
 */

namespace Sphere\Core\Request\ProductTypes\Command;

use Sphere\Core\Model\Common\Context;
use Sphere\Core\Model\ProductType\AttributeDefinition;
use Sphere\Core\Request\AbstractAction;

/**
 * @package Sphere\Core\Request\ProductTypes\Command
 * 
 * @method string getAction()
 * @method ProductTypeAddAttributeDefinitionAction setAction(string $action = null)
 * @method AttributeDefinition getAttribute()
 * @method ProductTypeAddAttributeDefinitionAction setAttribute(AttributeDefinition $attribute = null)
 */
class ProductTypeAddAttributeDefinitionAction extends AbstractAction
{
    public function getFields()
    {
        return [
            'action' => [static::TYPE => 'string'],
            'attribute' => [static::TYPE => '\Sphere\Core\Model\ProductType\AttributeDefinition']
        ];
    }

    /**
     * @param array $data
     * @param Context|callable $context
     */
    public function __construct(array $data = [], $context = null)
    {
        parent::__construct($data, $context);
        $this->setAction('addAttributeDefinition');
    }

    /**
     * @param AttributeDefinition $attribute
     * @param Context|callable $context
     * @return ProductTypeAddAttributeDefinitionAction
     */
    public static function ofAttribute(AttributeDefinition $attribute, $context = null)
    {
        return static::of($context)->setAttribute($attribute);
    }
}
