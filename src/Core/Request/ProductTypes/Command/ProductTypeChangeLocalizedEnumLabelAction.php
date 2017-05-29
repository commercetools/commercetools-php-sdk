<?php
/**
 * @author @jayS-de <jens.schulze@commercetools.de>
 */

namespace Commercetools\Core\Request\ProductTypes\Command;

use Commercetools\Core\Model\Common\Context;
use Commercetools\Core\Model\Common\LocalizedEnum;
use Commercetools\Core\Request\AbstractAction;

/**
 * @package Commercetools\Core\Request\ProductTypes\Command
 * @link https://dev.commercetools.com/http-api-projects-productTypes.html#change-the-label-of-an-localizedenumvalue
 * @method string getAction()
 * @method ProductTypeChangeLocalizedEnumLabelAction setAction(string $action = null)
 * @method string getAttributeName()
 * @method ProductTypeChangeLocalizedEnumLabelAction setAttributeName(string $attributeName = null)
 * @method LocalizedEnum getNewValue()
 * @method ProductTypeChangeLocalizedEnumLabelAction setNewValue(LocalizedEnum $newValue = null)
 */
class ProductTypeChangeLocalizedEnumLabelAction extends AbstractAction
{
    public function fieldDefinitions()
    {
        return [
            'action' => [static::TYPE => 'string'],
            'attributeName' => [static::TYPE => 'string'],
            'newValue' => [static::TYPE => LocalizedEnum::class]
        ];
    }

    /**
     * @param array $data
     * @param Context|callable $context
     */
    public function __construct(array $data = [], $context = null)
    {
        parent::__construct($data, $context);
        $this->setAction('changeLocalizedEnumValueLabel');
    }

    /**
     * @param string $attributeName
     * @param LocalizedEnum $enum
     * @param Context|callable $context
     * @return ProductTypeChangeLabelAction
     */
    public static function ofAttributeNameAndEnumValue($attributeName, LocalizedEnum $enum, $context = null)
    {
        return static::of($context)->setAttributeName($attributeName)->setNewValue($enum);
    }
}
