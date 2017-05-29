<?php
/**
 * @author @jayS-de <jens.schulze@commercetools.de>
 */

namespace Commercetools\Core\Request\Carts\Command;

use Commercetools\Core\Model\Common\Context;
use Commercetools\Core\Model\TaxCategory\ExternalTaxRateDraft;
use Commercetools\Core\Request\AbstractAction;
use Commercetools\Core\Model\Cart\ExternalLineItemTotalPrice;

/**
 * @package Commercetools\Core\Request\Carts\Command
 * @link https://dev.commercetools.com/http-api-projects-carts.html#set-lineitem-totalprice
 * @method string getAction()
 * @method CartSetLineItemTotalPriceAction setAction(string $action = null)
 * @method ExternalLineItemTotalPrice getExternalTotalPrice()
 * @method CartSetLineItemTotalPriceAction setExternalTotalPrice(ExternalLineItemTotalPrice $externalTotalPrice = null)
 * @method string getLineItemId()
 * @method CartSetLineItemTotalPriceAction setLineItemId(string $lineItemId = null)
 */
class CartSetLineItemTotalPriceAction extends AbstractAction
{
    public function fieldDefinitions()
    {
        return [
            'action' => [static::TYPE => 'string'],
            'lineItemId' => [static::TYPE => 'string'],
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
        $this->setAction('setLineItemTotalPrice');
    }

    /**
     * @param $lineItemId
     * @param Context|callable $context
     * @return CartSetLineItemTotalPriceAction
     */
    public static function ofLineItemId($lineItemId, $context = null)
    {
        return static::of($context)->setLineItemId($lineItemId);
    }
}
