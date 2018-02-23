<?php
/**
 * @author @jenschude <jens.schulze@commercetools.de>
 */

namespace Commercetools\Core\Request\ProductTypes\Command;

use Commercetools\Core\Model\Common\Context;
use Commercetools\Core\Request\AbstractAction;

/**
 * @package Commercetools\Core\Request\ProductTypes\Command
 * @codingStandardsIgnoreStart
 * @link https://docs.commercetools.com/http-api-projects-productTypes.html#change-attributedefinition-attributeconstraint
 * @codingStandardsIgnoreEnd
 * @method string getAction()
 * @method ProductTypeChangeAttributeConstraintAction setAction(string $action = null)
 * @method string getAttributeName()
 * @method ProductTypeChangeAttributeConstraintAction setAttributeName(string $attributeName = null)
 * @method string getNewValue()
 * @method ProductTypeChangeAttributeConstraintAction setNewValue(string $newValue = null)
 */
class ProductTypeChangeAttributeConstraintAction extends AbstractAction
{
    public function fieldDefinitions()
    {
        return [
            'action' => [static::TYPE => 'string'],
            'attributeName' => [static::TYPE => 'string'],
            'newValue' => [static::TYPE => 'string']
        ];
    }

    /**
     * @param array $data
     * @param Context|callable $context
     */
    public function __construct(array $data = [], $context = null)
    {
        parent::__construct($data, $context);
        $this->setAction('changeAttributeConstraint');
    }

    /**
     * @param string $attributeName
     * @param string $attributeConstraint
     * @param Context|callable $context
     * @return ProductTypeChangeAttributeConstraintAction
     */
    public static function ofAttributeNameAndAttributeConstraint($attributeName, $attributeConstraint, $context = null)
    {
        return static::of($context)->setAttributeName($attributeName)->setNewValue($attributeConstraint);
    }
}
