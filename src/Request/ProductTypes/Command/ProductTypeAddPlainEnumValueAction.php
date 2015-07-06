<?php
/**
 * @author @ct-jensschulze <jens.schulze@commercetools.de>
 */

namespace Sphere\Core\Request\ProductTypes\Command;


use Sphere\Core\Model\Common\Context;
use Sphere\Core\Model\Common\Enum;
use Sphere\Core\Request\AbstractAction;

class ProductTypeAddPlainEnumValueAction extends AbstractAction
{
    public function getFields()
    {
        return [
            'action' => [static::TYPE => 'string'],
            'attributeName' => [static::TYPE => 'string'],
            'value' => [static::TYPE => '\Sphere\Core\Model\Common\Enum']
        ];
    }

    /**
     * @param array $data
     * @param Context|callable $context
     */
    public function __construct(array $data = [], $context = null)
    {
        parent::__construct($data, $context);
        $this->setAction('addPlainEnumValue');
    }

    /**
     * @param string $attributeName
     * @param Enum $value
     * @param Context|callable $context
     * @return ProductTypeAddPlainEnumValueAction
     */
    public static function ofAttributeNameAndValue($attributeName, Enum $value, $context = null)
    {
        return static::of($context)->setAttributeName($attributeName)->setValue($value);
    }
}
