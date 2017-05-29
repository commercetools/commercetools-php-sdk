<?php
/**
 * @author @jayS-de <jens.schulze@commercetools.de>
 */

namespace Commercetools\Core\Request\TaxCategories\Command;

use Commercetools\Core\Model\Common\Context;
use Commercetools\Core\Model\TaxCategory\TaxRate;
use Commercetools\Core\Request\AbstractAction;

/**
 * @package Commercetools\Core\Request\TaxCategories\Command
 * @link https://dev.commercetools.com/http-api-projects-taxCategories.html#add-taxrate
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
            'taxRate' => [static::TYPE => TaxRate::class],
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
    public static function ofTaxRate(TaxRate $taxRate, $context = null)
    {
        return static::of($context)->setTaxRate($taxRate);
    }
}
