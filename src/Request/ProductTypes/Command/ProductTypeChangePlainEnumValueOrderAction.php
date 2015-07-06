<?php
/**
 * @author @ct-jensschulze <jens.schulze@commercetools.de>
 */

namespace Sphere\Core\Request\ProductTypes\Command;


use Sphere\Core\Model\Common\Context;
use Sphere\Core\Model\Common\EnumCollection;
use Sphere\Core\Request\AbstractAction;

class ProductTypeChangePlainEnumValueOrderAction extends AbstractAction
{
    public function getFields()
    {
        return [
            'action' => [static::TYPE => 'string'],
            'attributeName' => [static::TYPE => 'string'],
            'values' => [static::TYPE => '\Sphere\Core\Model\Common\EnumCollection']
        ];
    }

    /**
     * @param array $data
     * @param Context|callable $context
     */
    public function __construct(array $data = [], $context = null)
    {
        parent::__construct($data, $context);
        $this->setAction('changePlainEnumValueOrder');
    }

    /**
     * @param string $attributeName
     * @param EnumCollection $values
     * @param Context|callable $context
     * @return ProductTypeAddPlainEnumValueAction
     */
    public static function ofAttributeNameAndValues($attributeName, EnumCollection $values, $context = null)
    {
        return static::of($context)->setAttributeName($attributeName)->setValues($values);
    }
}
