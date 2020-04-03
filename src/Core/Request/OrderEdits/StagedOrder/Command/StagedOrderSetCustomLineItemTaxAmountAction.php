<?php
/**
 *
 */

namespace Commercetools\Core\Request\OrderEdits\StagedOrder\Command;

use Commercetools\Core\Request\Carts\Command\CartSetCustomLineItemTaxAmountAction;
use Commercetools\Core\Model\Cart\ExternalTaxAmountDraft;

/**
 * @package Commercetools\Core\Request\OrderEdits\StagedOrder\Command
 *
 * @method string getAction()
 * @method StagedOrderSetCustomLineItemTaxAmountAction setAction(string $action = null)
 * @method string getCustomLineItemId()
 * @method StagedOrderSetCustomLineItemTaxAmountAction setCustomLineItemId(string $customLineItemId = null)
 * @method ExternalTaxAmountDraft getExternalTaxAmount()
 * phpcs:disable
 * @method StagedOrderSetCustomLineItemTaxAmountAction setExternalTaxAmount(ExternalTaxAmountDraft $externalTaxAmount = null)
 * phpcs:enable
 */
// phpcs:ignore
class StagedOrderSetCustomLineItemTaxAmountAction extends CartSetCustomLineItemTaxAmountAction implements StagedOrderUpdateAction
{
}
