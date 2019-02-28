<?php
/**
 */

namespace Commercetools\Core\Request\ProductTypes\Command;

use Commercetools\Core\Model\Common\Context;
use Commercetools\Core\Model\ProductType\AttributeDefinitionCollection;
use Commercetools\Core\Request\AbstractAction;

/**
 * @package Commercetools\Core\Request\ProductTypes\Command
 * @link https://docs.commercetools.com/http-api-projects-productTypes#change-the-order-of-attributedefinitions
 * @method string getAction()
 * @method ProductTypeChangeAttributeOrderByNameAction setAction(string $action = null)
 * @method AttributeDefinitionCollection getAttributes()
 * @method ProductTypeChangeAttributeOrderByNameAction setAttributes(AttributeDefinitionCollection $attributes = null)
 * @method array getAttributeNames()
 * @method ProductTypeChangeAttributeOrderByNameAction setAttributeNames(array $attributeNames = null)
 */
class ProductTypeChangeAttributeOrderByNameAction extends AbstractAction
{
    public function fieldDefinitions()
    {
        return [
            'action' => [static::TYPE => 'string'],
            'attributeNames' => [static::TYPE => 'array'],
        ];
    }

    /**
     * @param array $data
     * @param Context|callable $context
     */
    public function __construct(array $data = [], $context = null)
    {
        parent::__construct($data, $context);
        $this->setAction('changeAttributeOrderByName');
    }

    /**
     * @param array $attributeNames
     * @param Context|callable $context
     * @return ProductTypeChangeAttributeOrderByNameAction
     */
    public static function ofAttributeNames(array $attributeNames, $context = null)
    {
        return static::of($context)->setAttributeNames($attributeNames);
    }
}
