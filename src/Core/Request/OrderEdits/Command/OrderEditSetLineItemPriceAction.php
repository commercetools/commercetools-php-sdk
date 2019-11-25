<?php

namespace Commercetools\Core\Request\OrderEdits\Command;

use Commercetools\Core\Model\Common\Money;
use Commercetools\Core\Request\AbstractAction;

/**
 * @package Commercetools\Core\Request\OrderEdits\Command
 * @link https://docs.commercetools.com/http-api-projects-order-edits.html#set-lineitem-price
 *
 * @method string getAction()
 * @method OrderEditSetLineItemPriceAction setAction(string $action = null)
 * @method string getLineItemId()
 * @method OrderEditSetLineItemPriceAction setLineItemId(string $lineItemId = null)
 * @method Money getExternalPrice()
 * @method OrderEditSetLineItemPriceAction setExternalPrice(Money $externalPrice = null)
 */
class OrderEditSetLineItemPriceAction extends AbstractAction
{
    public function fieldDefinitions()
    {
        return [
            'action' => [static::TYPE => 'string'],
            'lineItemId' => [static::TYPE => 'string'],
            'externalPrice' => [static::TYPE => Money::class],
        ];
    }

    public function __construct(array $data = [], $context = null)
    {
        parent::__construct($data, $context);
        $this->setAction('setLineItemPrice');
    }
}
