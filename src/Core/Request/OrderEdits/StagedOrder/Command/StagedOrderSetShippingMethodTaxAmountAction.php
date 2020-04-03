<?php
/**
 *
 */

namespace Commercetools\Core\Request\OrderEdits\StagedOrder\Command;

use Commercetools\Core\Request\Carts\Command\CartSetShippingMethodTaxAmountAction;
use Commercetools\Core\Model\Cart\ExternalTaxAmountDraft;

/**
 * @package Commercetools\Core\Request\OrderEdits\StagedOrder\Command
 *
 * @method string getAction()
 * @method StagedOrderSetShippingMethodTaxAmountAction setAction(string $action = null)
 * @method ExternalTaxAmountDraft getExternalTaxAmount()
 * phpcs:disable
 * @method StagedOrderSetShippingMethodTaxAmountAction setExternalTaxAmount(ExternalTaxAmountDraft $externalTaxAmount = null)
 * phpcs:enable
 */
// phpcs:ignore
class StagedOrderSetShippingMethodTaxAmountAction extends CartSetShippingMethodTaxAmountAction implements StagedOrderUpdateAction
{
}
