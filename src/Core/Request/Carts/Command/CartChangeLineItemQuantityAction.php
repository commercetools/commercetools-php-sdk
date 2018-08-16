<?php
/**
 * @author @jenschude <jens.schulze@commercetools.de>
 */

namespace Commercetools\Core\Request\Carts\Command;

use Commercetools\Core\Model\Cart\ExternalLineItemTotalPrice;
use Commercetools\Core\Model\Common\Context;
use Commercetools\Core\Model\Common\Money;
use Commercetools\Core\Request\AbstractAction;

/**
 * @package Commercetools\Core\Request\Carts\Command
 * @link https://docs.commercetools.com/http-api-projects-carts.html#change-lineitem-quantity
 * @method string getAction()
 * @method CartChangeLineItemQuantityAction setAction(string $action = null)
 * @method string getLineItemId()
 * @method CartChangeLineItemQuantityAction setLineItemId(string $lineItemId = null)
 * @method int getQuantity()
 * @method CartChangeLineItemQuantityAction setQuantity(int $quantity = null)
 * @method Money getExternalPrice()
 * @method CartChangeLineItemQuantityAction setExternalPrice(Money $externalPrice = null)
 * @method ExternalLineItemTotalPrice getExternalTotalPrice()
 * phpcs:disable
 * @method CartChangeLineItemQuantityAction setExternalTotalPrice(ExternalLineItemTotalPrice $externalTotalPrice = null)
 * phpcs:enable
 */
class CartChangeLineItemQuantityAction extends AbstractAction
{
    public function fieldDefinitions()
    {
        return [
            'action' => [static::TYPE => 'string'],
            'lineItemId' => [static::TYPE => 'string'],
            'quantity' => [static::TYPE => 'int'],
            'externalPrice' => [static::TYPE => Money::class],
            'externalTotalPrice' => [static::TYPE => ExternalLineItemTotalPrice::class],
        ];
    }

    /**
     * @param array $data
     * @param Context|callable $context
     */
    public function __construct(array $data = [], $context = null)
    {
        parent::__construct($data, $context);
        $this->setAction('changeLineItemQuantity');
    }

    /**
     * @param string $lineItemId
     * @param int $quantity
     * @param Context|callable $context
     * @return CartChangeLineItemQuantityAction
     */
    public static function ofLineItemIdAndQuantity($lineItemId, $quantity, $context = null)
    {
        return static::of($context)->setLineItemId($lineItemId)->setQuantity($quantity);
    }
}
