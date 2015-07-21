<?php
/**
 * @author @ct-jensschulze <jens.schulze@commercetools.de>
 */

namespace Sphere\Core\Request\ProductTypes\Command;

use Sphere\Core\Model\Common\Context;
use Sphere\Core\Model\Common\LocalizedEnumCollection;
use Sphere\Core\Request\AbstractAction;

/**
 * @package Sphere\Core\Request\ProductTypes\Command
 * 
 * @method string getAction()
 * @method ProductTypeChangeLocalizedEnumValueOrderAction setAction(string $action = null)
 * @method string getAttributeName()
 * @method ProductTypeChangeLocalizedEnumValueOrderAction setAttributeName(string $attributeName = null)
 * @method LocalizedEnumCollection getValues()
 * @method ProductTypeChangeLocalizedEnumValueOrderAction setValues(LocalizedEnumCollection $values = null)
 */
class ProductTypeChangeLocalizedEnumValueOrderAction extends AbstractAction
{
    public function getFields()
    {
        return [
            'action' => [static::TYPE => 'string'],
            'attributeName' => [static::TYPE => 'string'],
            'values' => [static::TYPE => '\Sphere\Core\Model\Common\LocalizedEnumCollection']
        ];
    }

    /**
     * @param array $data
     * @param Context|callable $context
     */
    public function __construct(array $data = [], $context = null)
    {
        parent::__construct($data, $context);
        $this->setAction('changeLocalizedEnumValueOrder');
    }

    /**
     * @param string $attributeName
     * @param LocalizedEnumCollection $values
     * @param Context|callable $context
     * @return ProductTypeChangeLocalizedEnumValueOrderAction
     */
    public static function ofAttributeNameAndValues($attributeName, LocalizedEnumCollection $values, $context = null)
    {
        return static::of($context)->setAttributeName($attributeName)->setValues($values);
    }
}
