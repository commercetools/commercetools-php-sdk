<?php
/**
 * @author @jayS-de <jens.schulze@commercetools.de>
 */

namespace Commercetools\Core\Request\Carts\Command;

use Commercetools\Core\Model\Common\Context;
use Commercetools\Core\Model\Common\Money;
use Commercetools\Core\Model\TaxCategory\ExternalTaxRateDraft;
use Commercetools\Core\Request\AbstractAction;
use Commercetools\Core\Model\Cart\ExternalLineItemTotalPrice;

/**
 * @package Commercetools\Core\Request\Carts\Command
 * @link https://dev.commercetools.com/http-api-projects-carts.html#set-lineitem-totalprice
 * @method string getAction()
 * @method CartSetLineItemPriceAction setAction(string $action = null)
 * @method string getLineItemId()
 * @method CartSetLineItemPriceAction setLineItemId(string $lineItemId = null)
 * @method Money getExternalPrice()
 * @method CartSetLineItemPriceAction setExternalPrice(Money $externalPrice = null)
 */
class CartSetLineItemPriceAction extends AbstractAction
{
    public function fieldDefinitions()
    {
        return [
            'action' => [static::TYPE => 'string'],
            'lineItemId' => [static::TYPE => 'string'],
            'externalPrice' => [static::TYPE => Money::class],
        ];
    }

    /**
     * @param array $data
     * @param Context|callable $context
     */
    public function __construct(array $data = [], $context = null)
    {
        parent::__construct($data, $context);
        $this->setAction('setLineItemPrice');
    }

    /**
     * @param $lineItemId
     * @param Context|callable $context
     * @return CartSetLineItemPriceAction
     */
    public static function ofLineItemId($lineItemId, $context = null)
    {
        return static::of($context)->setLineItemId($lineItemId);
    }
}
