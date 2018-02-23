<?php
/**
 * @author @jenschude <jens.schulze@commercetools.de>
 */

namespace Commercetools\Core\Request\ProductTypes\Command;

use Commercetools\Core\Model\Common\Context;
use Commercetools\Core\Model\Common\EnumCollection;
use Commercetools\Core\Request\AbstractAction;

/**
 * @package Commercetools\Core\Request\ProductTypes\Command
 * @link https://docs.commercetools.com/http-api-projects-productTypes.html#change-the-order-of-enumvalues
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
            'values' => [static::TYPE => EnumCollection::class]
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
     * @return ProductTypeChangePlainEnumValueOrderAction
     */
    public static function ofAttributeNameAndValues($attributeName, EnumCollection $values, $context = null)
    {
        return static::of($context)->setAttributeName($attributeName)->setValues($values);
    }
}
