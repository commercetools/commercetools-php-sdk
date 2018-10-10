<?php
/**
 *
 */

namespace Commercetools\Core\Request\OrderEdits\Command;

use Commercetools\Core\Request\Carts\Command\CartSetCustomLineItemTaxAmountAction;
use Commercetools\Core\Model\Cart\ExternalTaxAmountDraft;

/**
 * @package Commercetools\Core\Request\OrderEdits\Command
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
class StagedOrderSetCustomLineItemTaxAmountAction extends CartSetCustomLineItemTaxAmountAction implements StagedOrderUpdateAction
{

}
