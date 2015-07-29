<?php
/**
 * @author @ct-jensschulze <jens.schulze@commercetools.de>
 */

namespace Sphere\Core\Request\ProductTypes\Command;

use Sphere\Core\Model\Common\Context;
use Sphere\Core\Model\ProductType\AttributeDefinitionCollection;
use Sphere\Core\Request\AbstractAction;

/**
 * @package Sphere\Core\Request\ProductTypes\Command
 * 
 * @method string getAction()
 * @method ProductTypeChangeAttributeOrderAction setAction(string $action = null)
 * @method AttributeDefinitionCollection getAttributes()
 * @method ProductTypeChangeAttributeOrderAction setAttributes(AttributeDefinitionCollection $attributes = null)
 */
class ProductTypeChangeAttributeOrderAction extends AbstractAction
{
    public function getFields()
    {
        return [
            'action' => [static::TYPE => 'string'],
            'attributes' => [static::TYPE => '\Sphere\Core\Model\ProductType\AttributeDefinitionCollection'],
        ];
    }

    /**
     * @param array $data
     * @param Context|callable $context
     */
    public function __construct(array $data = [], $context = null)
    {
        parent::__construct($data, $context);
        $this->setAction('changeAttributeOrder');
    }

    /**
     * @param AttributeDefinitionCollection $attributes
     * @param Context|callable $context
     * @return ProductTypeChangeAttributeOrderAction
     */
    public static function ofAttributes(AttributeDefinitionCollection $attributes, $context = null)
    {
        return static::of($context)->setAttributes($attributes);
    }
}
