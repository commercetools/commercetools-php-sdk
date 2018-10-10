<?php
/**
 *
 */

namespace Commercetools\Core\Request\OrderEdits\Command;

use Commercetools\Core\Request\Carts\Command\CartSetLineItemTaxAmountAction;
use Commercetools\Core\Model\Cart\ExternalTaxAmountDraft;

/**
 * @package Commercetools\Core\Request\OrderEdits\Command
 *
 * @method string getAction()
 * @method StagedOrderSetLineItemTaxAmountAction setAction(string $action = null)
 * @method string getLineItemId()
 * @method StagedOrderSetLineItemTaxAmountAction setLineItemId(string $lineItemId = null)
 * @method ExternalTaxAmountDraft getExternalTaxAmount()
 * @method StagedOrderSetLineItemTaxAmountAction setExternalTaxAmount(ExternalTaxAmountDraft $externalTaxAmount = null)
 */
class StagedOrderSetLineItemTaxAmountAction extends CartSetLineItemTaxAmountAction implements StagedOrderUpdateAction
{

}
