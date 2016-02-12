<?php
/**
 * @author @jayS-de <jens.schulze@commercetools.de>
 */

namespace Commercetools\Core\Request\ProductTypes\Command;

use Commercetools\Core\Model\Common\Context;
use Commercetools\Core\Model\Common\EnumCollection;
use Commercetools\Core\Request\AbstractAction;

/**
 * @package Commercetools\Core\Request\ProductTypes\Command
 * @link https://dev.commercetools.com/http-api-projects-productTypes.html#change-order-enum-values-attribute-definition
 * @method string getAction()
 * @method ProductTypeChangePlainEnumValueOrderAction setAction(string $action = null)
 * @method string getAttributeName()
 * @method ProductTypeChangePlainEnumValueOrderAction setAttributeName(string $attributeName = null)
 * @method EnumCollection getValues()
 * @method ProductTypeChangePlainEnumValueOrderAction setValues(EnumCollection $values = null)
 */
class ProductTypeChangePlainEnumValueOrderAction extends AbstractAction
{
    public function fieldDefinitions()
    {
        return [
            'action' => [static::TYPE => 'string'],
            'attributeName' => [static::TYPE => 'string'],
            'values' => [static::TYPE => '\Commercetools\Core\Model\Common\EnumCollection']
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
