<?php
/**
 * @author @jenschude <jens.schulze@commercetools.de>
 */

namespace Commercetools\Core\Request\ProductTypes\Command;

use Commercetools\Core\Model\Common\Context;
use Commercetools\Core\Model\Common\Enum;
use Commercetools\Core\Request\AbstractAction;

/**
 * @package Commercetools\Core\Request\ProductTypes\Command
 * @link https://docs.commercetools.com/http-api-projects-productTypes.html#change-the-label-of-an-enumvalue
 * @method string getAction()
 * @method ProductTypeChangePlainEnumLabelAction setAction(string $action = null)
 * @method string getAttributeName()
 * @method ProductTypeChangePlainEnumLabelAction setAttributeName(string $attributeName = null)
 * @method Enum getNewValue()
 * @method ProductTypeChangePlainEnumLabelAction setNewValue(Enum $newValue = null)
 */
class ProductTypeChangePlainEnumLabelAction extends AbstractAction
{
    public function fieldDefinitions()
    {
        return [
            'action' => [static::TYPE => 'string'],
            'attributeName' => [static::TYPE => 'string'],
            'newValue' => [static::TYPE => Enum::class]
        ];
    }

    /**
     * @param array $data
     * @param Context|callable $context
     */
    public function __construct(array $data = [], $context = null)
    {
        parent::__construct($data, $context);
        $this->setAction('changePlainEnumValueLabel');
    }

    /**
     * @param string $attributeName
     * @param Enum $enum
     * @param Context|callable $context
     * @return ProductTypeChangePlainEnumLabelAction
     */
    public static function ofAttributeNameAndEnumValue($attributeName, Enum $enum, $context = null)
    {
        return static::of($context)->setAttributeName($attributeName)->setNewValue($enum);
    }
}
