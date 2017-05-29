<?php
/**
 * @author @jayS-de <jens.schulze@commercetools.de>
 */

namespace Commercetools\Core\Request\Carts\Command;

use Commercetools\Core\Model\Common\Context;
use Commercetools\Core\Request\AbstractAction;
use Commercetools\Core\Model\Common\Money;

/**
 * @package Commercetools\Core\Request\Carts\Command
 * @link https://dev.commercetools.com/http-api-projects-carts.html#change-customlineitem-money
 * @method string getAction()
 * @method CartChangeCustomLineItemMoneyAction setAction(string $action = null)
 * @method string getCustomLineItemId()
 * @method CartChangeCustomLineItemMoneyAction setCustomLineItemId(string $customLineItemId = null)
 * @method Money getMoney()
 * @method CartChangeCustomLineItemMoneyAction setMoney(Money $money = null)
 */
class CartChangeCustomLineItemMoneyAction extends AbstractAction
{
    public function fieldDefinitions()
    {
        return [
            'action' => [static::TYPE => 'string'],
            'customLineItemId' => [static::TYPE => 'string'],
            'money' => [static::TYPE => Money::class],
        ];
    }

    /**
     * @param array $data
     * @param Context|callable $context
     */
    public function __construct(array $data = [], $context = null)
    {
        parent::__construct($data, $context);
        $this->setAction('changeCustomLineItemMoney');
    }

    /**
     * @param string $customLineItemId
     * @param Money $money
     * @param Context|callable $context
     * @return CartSetLineItemTotalPriceAction
     */
    public static function ofCustomLineItemIdAndMoney($customLineItemId, Money $money, $context = null)
    {
        return static::of($context)->setCustomLineItemId($customLineItemId)->setMoney($money);
    }
}
