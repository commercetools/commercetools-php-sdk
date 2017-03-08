<?php
/**
 * @author @jayS-de <jens.schulze@commercetools.de>
 */

namespace Commercetools\Core\Request\ProductTypes\Command;

use Commercetools\Core\Model\Common\Context;
use Commercetools\Core\Model\Common\LocalizedEnumCollection;
use Commercetools\Core\Request\AbstractAction;

/**
 * @package Commercetools\Core\Request\ProductTypes\Command
 * @codingStandardsIgnoreStart
 * @link https://dev.commercetools.com/http-api-projects-productTypes.html#change-the-order-of-localizedenumvalues
 * @codingStandardsIgnoreEnd
 * @method string getAction()
 * @method ProductTypeChangeLocalizedEnumValueOrderAction setAction(string $action = null)
 * @method string getAttributeName()
 * @method ProductTypeChangeLocalizedEnumValueOrderAction setAttributeName(string $attributeName = null)
 * @method LocalizedEnumCollection getValues()
 * @method ProductTypeChangeLocalizedEnumValueOrderAction setValues(LocalizedEnumCollection $values = null)
 */
class ProductTypeChangeLocalizedEnumValueOrderAction extends AbstractAction
{
    public function fieldDefinitions()
    {
        return [
            'action' => [static::TYPE => 'string'],
            'attributeName' => [static::TYPE => 'string'],
            'values' => [static::TYPE => LocalizedEnumCollection::class]
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
