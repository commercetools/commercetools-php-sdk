<?php
/**
 * @author @jayS-de <jens.schulze@commercetools.de>
 */

namespace Commercetools\Core\Request\ProductTypes\Command;

use Commercetools\Core\Model\Common\Context;
use Commercetools\Core\Model\Common\Enum;
use Commercetools\Core\Request\AbstractAction;

/**
 * @package Commercetools\Core\Request\ProductTypes\Command
 * @link https://dev.commercetools.com/http-api-projects-productTypes.html#add-plain-enum-value-to-attribute-definition
 * @method string getAction()
 * @method ProductTypeAddPlainEnumValueAction setAction(string $action = null)
 * @method string getAttributeName()
 * @method ProductTypeAddPlainEnumValueAction setAttributeName(string $attributeName = null)
 * @method Enum getValue()
 * @method ProductTypeAddPlainEnumValueAction setValue(Enum $value = null)
 */
class ProductTypeAddPlainEnumValueAction extends AbstractAction
{
    public function fieldDefinitions()
    {
        return [
            'action' => [static::TYPE => 'string'],
            'attributeName' => [static::TYPE => 'string'],
            'value' => [static::TYPE => '\Commercetools\Core\Model\Common\Enum']
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
