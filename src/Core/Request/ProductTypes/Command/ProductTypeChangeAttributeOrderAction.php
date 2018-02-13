<?php
/**
 * @author @jenschude <jens.schulze@commercetools.de>
 */

namespace Commercetools\Core\Request\ProductTypes\Command;

use Commercetools\Core\Model\Common\Context;
use Commercetools\Core\Model\ProductType\AttributeDefinitionCollection;
use Commercetools\Core\Request\AbstractAction;

/**
 * @package Commercetools\Core\Request\ProductTypes\Command
 * @link https://docs.commercetools.com/http-api-projects-productTypes.html#change-the-order-of-attributedefinitions
 * @method string getAction()
 * @method ProductTypeChangeAttributeOrderAction setAction(string $action = null)
 * @method AttributeDefinitionCollection getAttributes()
 * @method ProductTypeChangeAttributeOrderAction setAttributes(AttributeDefinitionCollection $attributes = null)
 */
class ProductTypeChangeAttributeOrderAction extends AbstractAction
{
    public function fieldDefinitions()
    {
        return [
            'action' => [static::TYPE => 'string'],
            'attributes' => [static::TYPE => AttributeDefinitionCollection::class],
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
