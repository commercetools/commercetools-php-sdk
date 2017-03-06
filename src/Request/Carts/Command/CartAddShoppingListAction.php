<?php
/**
 * @author @jayS-de <jens.schulze@commercetools.de>
 */

namespace Commercetools\Core\Request\Carts\Command;

use Commercetools\Core\Model\Common\Context;
use Commercetools\Core\Request\AbstractAction;
use Commercetools\Core\Model\ShoppingList\ShoppingListReference;
use Commercetools\Core\Model\Channel\ChannelReference;

/**
 * @package Commercetools\Core\Request\Carts\Command
 * @link https://dev.commercetools.com/http-api-projects-carts.html#add-shoppinglist
 * @method string getAction()
 * @method CartAddShoppingListAction setAction(string $action = null)
 * @method ShoppingListReference getShoppingList()
 * @method CartAddShoppingListAction setShoppingList(ShoppingListReference $shoppingList = null)
 * @method ChannelReference getSupplyChannel()
 * @method CartAddShoppingListAction setSupplyChannel(ChannelReference $supplyChannel = null)
 * @method ChannelReference getDistributionChannel()
 * @method CartAddShoppingListAction setDistributionChannel(ChannelReference $distributionChannel = null)
 */
class CartAddShoppingListAction extends AbstractAction
{
    public function fieldDefinitions()
    {
        return [
            'action' => [static::TYPE => 'string'],
            'shoppingList' => [static::TYPE => ShoppingListReference::class],
            'supplyChannel' => [static::TYPE => ChannelReference::class],
            'distributionChannel' => [static::TYPE => ChannelReference::class],
        ];
    }

    /**
     * @param array $data
     * @param Context|callable $context
     */
    public function __construct(array $data = [], $context = null)
    {
        parent::__construct($data, $context);
        $this->setAction('addShoppingList');
    }

    public static function ofShoppingList(
        ShoppingListReference $shoppingList,
        $context = null
    ) {
        return static::of($context)
            ->setShoppingList($shoppingList);
    }
}
