<?php
/**
 * @author @ct-jensschulze <jens.schulze@commercetools.de>
 */

namespace Commercetools\Core\Request\ProductTypes\Command;

use Commercetools\Core\Model\Common\Context;
use Commercetools\Core\Model\ProductType\AttributeDefinition;
use Commercetools\Core\Request\AbstractAction;

/**
 * @package Commercetools\Core\Request\ProductTypes\Command
 *
 * @method string getAction()
 * @method ProductTypeAddAttributeDefinitionAction setAction(string $action = null)
 * @method AttributeDefinition getAttribute()
 * @method ProductTypeAddAttributeDefinitionAction setAttribute(AttributeDefinition $attribute = null)
 */
class ProductTypeAddAttributeDefinitionAction extends AbstractAction
{
    public function getPropertyDefinitions()
    {
        return [
            'action' => [static::TYPE => 'string'],
            'attribute' => [static::TYPE => '\Commercetools\Core\Model\ProductType\AttributeDefinition']
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
