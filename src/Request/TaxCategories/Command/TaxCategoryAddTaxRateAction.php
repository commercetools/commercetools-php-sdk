<?php
/**
 * @author @ct-jensschulze <jens.schulze@commercetools.de>
 */

namespace Commercetools\Core\Request\TaxCategories\Command;

use Commercetools\Core\Model\Common\Context;
use Commercetools\Core\Model\TaxCategory\TaxRate;
use Commercetools\Core\Request\AbstractAction;

/**
 * @package Commercetools\Core\Request\TaxCategories\Command
 *  *
 * @method string getAction()
 * @method TaxCategoryAddTaxRateAction setAction(string $action = null)
 * @method TaxRate getTaxRate()
 * @method TaxCategoryAddTaxRateAction setTaxRate(TaxRate $taxRate = null)
 */
class TaxCategoryAddTaxRateAction extends AbstractAction
{
    public function fieldDefinitions()
    {
        return [
            'action' => [static::TYPE => 'string'],
            'taxRate' => [static::TYPE => '\Commercetools\Core\Model\TaxCategory\TaxRate'],
        ];
    }

    /**
     * @param array $data
     * @param Context|callable $context
     */
    public function __construct(array $data = [], $context = null)
    {
        parent::__construct($data, $context);
        $this->setAction('addTaxRate');
    }

    /**
     * @param TaxRate $taxRate
     * @param Context|callable $context
     * @return TaxCategoryAddTaxRateAction
     */
    public function ofTaxRate(TaxRate $taxRate, $context = null)
    {
        return static::of($context)->setTaxRate($taxRate);
    }
}
