<?php
/**
 * @author @ct-jensschulze <jens.schulze@commercetools.de>
 */

namespace Sphere\Core\Request\ShippingMethods\Command;

use Sphere\Core\Model\Common\Context;
use Sphere\Core\Model\TaxCategory\TaxCategoryReference;
use Sphere\Core\Request\AbstractAction;

/**
 * Class ShippingMethodChangeTaxCategoryAction
 * @package Sphere\Core\Request\ShippingMethods\Command
 * 
 * @method string getAction()
 * @method ShippingMethodChangeTaxCategoryAction setAction(string $action = null)
 * @method TaxCategoryReference getTaxCategory()
 * @method ShippingMethodChangeTaxCategoryAction setTaxCategory(TaxCategoryReference $taxCategory = null)
 */
class ShippingMethodChangeTaxCategoryAction extends AbstractAction
{
    public function getFields()
    {
        return [
            'action' => [static::TYPE => 'string'],
            'taxCategory' => [static::TYPE => '\Sphere\Core\Model\TaxCategory\TaxCategoryReference'],
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
