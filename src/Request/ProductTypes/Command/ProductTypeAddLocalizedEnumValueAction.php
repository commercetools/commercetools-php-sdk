<?php
/**
 * @author @ct-jensschulze <jens.schulze@commercetools.de>
 */

namespace Commercetools\Core\Request\ProductTypes\Command;

use Commercetools\Core\Model\Common\Context;
use Commercetools\Core\Model\Common\LocalizedEnum;
use Commercetools\Core\Request\AbstractAction;

/**
 * @package Commercetools\Core\Request\ProductTypes\Command
 *
 * @method string getAction()
 * @method ProductTypeAddLocalizedEnumValueAction setAction(string $action = null)
 * @method string getAttributeName()
 * @method ProductTypeAddLocalizedEnumValueAction setAttributeName(string $attributeName = null)
 * @method LocalizedEnum getValue()
 * @method ProductTypeAddLocalizedEnumValueAction setValue(LocalizedEnum $value = null)
 */
class ProductTypeAddLocalizedEnumValueAction extends AbstractAction
{
    public function fieldDefinitions()
    {
        return [
            'action' => [static::TYPE => 'string'],
            'attributeName' => [static::TYPE => 'string'],
            'value' => [static::TYPE => '\Commercetools\Core\Model\Common\LocalizedEnum']
        ];
    }

    /**
     * @param array $data
     * @param Context|callable $context
     */
    public function __construct(array $data = [], $context = null)
    {
        parent::__construct($data, $context);
        $this->setAction('addLocalizedEnumValue');
    }

    /**
     * @param string $attributeName
     * @param LocalizedEnum $value
     * @param Context|callable $context
     * @return ProductTypeAddLocalizedEnumValueAction
     */
    public static function ofAttributeNameAndValue($attributeName, LocalizedEnum $value, $context = null)
    {
        return static::of($context)->setAttributeName($attributeName)->setValue($value);
    }
}
