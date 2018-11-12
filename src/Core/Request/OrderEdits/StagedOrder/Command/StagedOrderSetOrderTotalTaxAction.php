<?php
/**
 *
 */

namespace Commercetools\Core\Request\OrderEdits\StagedOrder\Command;

use Commercetools\Core\Model\Common\Context;
use Commercetools\Core\Request\Carts\Command\CartSetCartTotalTaxAction;
use Commercetools\Core\Model\Common\Money;
use Commercetools\Core\Model\Common\TaxPortionCollection;

/**
 * @package Commercetools\Core\Request\OrderEdits\StagedOrder\Command
 *
 * @method string getAction()
 * @method StagedOrderSetOrderTotalTaxAction setAction(string $action = null)
 * @method Money getExternalTotalGross()
 * @method StagedOrderSetOrderTotalTaxAction setExternalTotalGross(Money $externalTotalGross = null)
 * @method TaxPortionCollection getExternalTaxPortions()
 * @method StagedOrderSetOrderTotalTaxAction setExternalTaxPortions(TaxPortionCollection $externalTaxPortions = null)
 */
class StagedOrderSetOrderTotalTaxAction extends CartSetCartTotalTaxAction implements StagedOrderUpdateAction
{
    /**
     * @param array $data
     * @param Context|callable $context
     */
    public function __construct(array $data = [], $context = null)
    {
        parent::__construct($data, $context);
        $this->setAction('setOrderTotalTax');
    }
}
