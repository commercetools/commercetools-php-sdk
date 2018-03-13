<?php
/**
 * @author @jenschude <jens.schulze@commercetools.de>
 */

namespace Commercetools\Core\Request\Carts\Command;

use Commercetools\Core\Model\Common\Context;
use Commercetools\Core\Model\Common\Money;
use Commercetools\Core\Model\Common\TaxPortionCollection;
use Commercetools\Core\Request\AbstractAction;

/**
 * @package Commercetools\Core\Request\Carts\Command
 *
 * @method string getAction()
 * @method CartSetCartTotalTaxAction setAction(string $action = null)
 * @method Money getExternalTotalGross()
 * @method CartSetCartTotalTaxAction setExternalTotalGross(Money $externalTotalGross = null)
 * @method TaxPortionCollection getExternalTaxPortions()
 * @method CartSetCartTotalTaxAction setExternalTaxPortions(TaxPortionCollection $externalTaxPortions = null)
 */
class CartSetCartTotalTaxAction extends AbstractAction
{
    public function fieldDefinitions()
    {
        return [
            'action' => [static::TYPE => 'string'],
            'externalTotalGross' => [static::TYPE => Money::class],
            'externalTaxPortions' => [static::TYPE => TaxPortionCollection::class],
        ];
    }

    /**
     * @param array $data
     * @param Context|callable $context
     */
    public function __construct(array $data = [], $context = null)
    {
        parent::__construct($data, $context);
        $this->setAction('setCartTotalTax');
    }
}
