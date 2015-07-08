<?php
/**
 * @author @ct-jensschulze <jens.schulze@commercetools.de>
 */

namespace Sphere\Core\Request\TaxCategories\Command;

use Sphere\Core\Model\Common\Context;
use Sphere\Core\Model\TaxCategory\TaxRate;
use Sphere\Core\Request\AbstractAction;

/**
 * Class TaxCategoryReplaceTaxRateAction
 * @package Sphere\Core\Request\TaxCategories\Command
 * 
 * @method string getAction()
 * @method TaxCategoryReplaceTaxRateAction setAction(string $action = null)
 * @method string getTaxRateId()
 * @method TaxCategoryReplaceTaxRateAction setTaxRateId(string $taxRateId = null)
 * @method TaxRate getTaxRate()
 * @method TaxCategoryReplaceTaxRateAction setTaxRate(TaxRate $taxRate = null)
 */
class TaxCategoryReplaceTaxRateAction extends AbstractAction
{
    public function getFields()
    {
        return [
            'action' => [static::TYPE => 'string'],
            'taxRateId' => [static::TYPE => 'string'],
            'taxRate' => [static::TYPE => '\Sphere\Core\Model\TaxCategory\TaxRate'],
        ];
    }

    /**
     * @param array $data
     * @param Context|callable $context
     */
    public function __construct(array $data = [], $context = null)
    {
        parent::__construct($data, $context);
        $this->setAction('replaceTaxRate');
    }

    /**
     * @param string $taxRateId
     * @param TaxRate $taxRate
     * @param Context|callable $context
     * @return TaxCategoryReplaceTaxRateAction
     */
    public function ofTaxRateIdAndTaxRate($taxRateId, TaxRate $taxRate, $context = null)
    {
        return static::of($context)->setTaxRateId($taxRateId)->setTaxRate($taxRate);
    }
}
