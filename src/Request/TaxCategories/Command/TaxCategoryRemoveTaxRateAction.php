<?php
/**
 * @author @ct-jensschulze <jens.schulze@commercetools.de>
 */

namespace Sphere\Core\Request\TaxCategories\Command;

use Sphere\Core\Model\Common\Context;
use Sphere\Core\Request\AbstractAction;

/**
 * @package Sphere\Core\Request\TaxCategories\Command
 *  *
 * @method string getAction()
 * @method TaxCategoryRemoveTaxRateAction setAction(string $action = null)
 * @method string getTaxRateId()
 * @method TaxCategoryRemoveTaxRateAction setTaxRateId(string $taxRateId = null)
 * @method string getRateId()
 * @method TaxCategoryRemoveTaxRateAction setRateId(string $rateId = null)
 */
class TaxCategoryRemoveTaxRateAction extends AbstractAction
{
    public function getFields()
    {
        return [
            'action' => [static::TYPE => 'string'],
            'rateId' => [static::TYPE => 'string']
        ];
    }

    /**
     * @param array $data
     * @param Context|callable $context
     */
    public function __construct(array $data = [], $context = null)
    {
        parent::__construct($data, $context);
        $this->setAction('removeTaxRate');
    }

    /**
     * @param string $taxRateId
     * @param Context|callable $context
     * @return TaxCategoryRemoveTaxRateAction
     */
    public function ofTaxRateId($taxRateId, $context = null)
    {
        return static::of($context)->setTaxRateId($taxRateId);
    }
}
