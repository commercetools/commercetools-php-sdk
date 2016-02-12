<?php
/**
 * @author @jayS-de <jens.schulze@commercetools.de>
 */

namespace Commercetools\Core\Request\ShippingMethods\Command;

use Commercetools\Core\Model\Common\Context;
use Commercetools\Core\Model\TaxCategory\TaxCategoryReference;
use Commercetools\Core\Request\AbstractAction;

/**
 * @package Commercetools\Core\Request\ShippingMethods\Command
 * @link https://dev.commercetools.com/http-api-projects-shippingMethods.html#change-tax-category
 * @method string getAction()
 * @method ShippingMethodChangeTaxCategoryAction setAction(string $action = null)
 * @method TaxCategoryReference getTaxCategory()
 * @method ShippingMethodChangeTaxCategoryAction setTaxCategory(TaxCategoryReference $taxCategory = null)
 */
class ShippingMethodChangeTaxCategoryAction extends AbstractAction
{
    public function fieldDefinitions()
    {
        return [
            'action' => [static::TYPE => 'string'],
            'taxCategory' => [static::TYPE => '\Commercetools\Core\Model\TaxCategory\TaxCategoryReference'],
        ];
    }

    /**
     * @param array $data
     * @param Context|callable $context
     */
    public function __construct(array $data = [], $context = null)
    {
        parent::__construct($data, $context);
        $this->setAction('changeTaxCategory');
    }

    /**
     * @param TaxCategoryReference $taxCategory
     * @param Context|callable $context
     * @return ShippingMethodChangeTaxCategoryAction
     */
    public static function ofTaxCategory(TaxCategoryReference $taxCategory, $context = null)
    {
        return static::of($context)->setTaxCategory($taxCategory);
    }
}
