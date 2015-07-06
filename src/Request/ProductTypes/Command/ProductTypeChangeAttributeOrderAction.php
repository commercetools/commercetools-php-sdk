<?php
/**
 * @author @ct-jensschulze <jens.schulze@commercetools.de>
 */

namespace Sphere\Core\Request\ProductTypes\Command;


use Sphere\Core\Model\Common\Context;
use Sphere\Core\Model\ProductType\AttributeDefinitionCollection;
use Sphere\Core\Request\AbstractAction;

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
