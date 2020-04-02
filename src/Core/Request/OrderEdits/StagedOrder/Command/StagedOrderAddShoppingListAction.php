<?php
/**
 *
 */

namespace Commercetools\Core\Request\OrderEdits\StagedOrder\Command;

use Commercetools\Core\Request\Carts\Command\CartAddShoppingListAction;
use Commercetools\Core\Model\ShoppingList\ShoppingListReference;
use Commercetools\Core\Model\Channel\ChannelReference;

/**
 * @package Commercetools\Core\Request\OrderEdits\StagedOrder\Command
 *
 * @method string getAction()
 * @method StagedOrderAddShoppingListAction setAction(string $action = null)
 * @method ShoppingListReference getShoppingList()
 * @method StagedOrderAddShoppingListAction setShoppingList(ShoppingListReference $shoppingList = null)
 * @method ChannelReference getSupplyChannel()
 * @method StagedOrderAddShoppingListAction setSupplyChannel(ChannelReference $supplyChannel = null)
 * @method ChannelReference getDistributionChannel()
 * @method StagedOrderAddShoppingListAction setDistributionChannel(ChannelReference $distributionChannel = null)
 */
class StagedOrderAddShoppingListAction extends CartAddShoppingListAction implements StagedOrderUpdateAction
{
}
