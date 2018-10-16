<?php
/**
 *
 */

namespace Commercetools\Core\Request\OrderEdits;

use Commercetools\Core\Request\OrderEdits\Command\OrderEditSetStagedActionsAction;
use Commercetools\Core\Request\OrderEdits\StagedOrder\Command\StagedOrderAddLineItemAction;
use Commercetools\Core\Request\OrderEdits\StagedOrder\Command\StagedOrderUpdateActionCollection;
use Commercetools\Core\RequestTestCase;

class OrderEditUpdateRequestTest extends RequestTestCase
{

    public function testSetStagedActions()
    {
        $orderUpdate = OrderEditUpdateRequest::ofIdAndVersion('123', 1)->setActions([
            OrderEditSetStagedActionsAction::of()->setStagedActions(
                StagedOrderUpdateActionCollection::of()->add(
                    StagedOrderAddLineItemAction::ofSkuAndQuantity('1234', 5)
                )
            )
        ]);

        $stagedActionsAction = current($orderUpdate->getActions());
        $this->assertInstanceOf(OrderEditSetStagedActionsAction::class, $stagedActionsAction);

        $stagedActions = $stagedActionsAction->getStagedActions();
        $this->assertInstanceOf(StagedOrderAddLineItemAction::class, $stagedActions->current());
    }
}
