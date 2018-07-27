<?php
/**
 */

namespace Commercetools\Core\Request\Carts\Command;

use Commercetools\Core\Model\Cart\ItemShippingDetailsDraft;
use Commercetools\Core\Model\Common\Context;
use Commercetools\Core\Request\AbstractAction;

/**
 * @package Commercetools\Core\Request\Carts\Command
 * @link https://docs.commercetools.com/http-api-projects-carts.html#set-lineitem-totalprice
 * @method string getAction()
 * @method CartSetLineItemShippingDetailsAction setAction(string $action = null)
 * @method string getLineItemId()
 * @method CartSetLineItemShippingDetailsAction setLineItemId(string $lineItemId = null)
 * @method ItemShippingDetailsDraft getShippingDetails()
 * @method CartSetLineItemShippingDetailsAction setShippingDetails(ItemShippingDetailsDraft $shippingDetails = null)
 */
class CartSetLineItemShippingDetailsAction extends AbstractAction
{
    public function fieldDefinitions()
    {
        return [
            'action' => [static::TYPE => 'string'],
            'lineItemId' => [static::TYPE => 'string'],
            'shippingDetails' => [static::TYPE => ItemShippingDetailsDraft::class],
        ];
    }

    /**
     * @param array $data
     * @param Context|callable $context
     */
    public function __construct(array $data = [], $context = null)
    {
        parent::__construct($data, $context);
        $this->setAction('setLineItemShippingDetails');
    }

    /**
     * @param $lineItemId
     * @param ItemShippingDetailsDraft $itemShippingDetailsDraft
     * @param Context|callable $context
     * @return CartSetLineItemShippingDetailsAction
     */
    public static function ofLineItemIdAndShippingDetails(
        $lineItemId,
        ItemShippingDetailsDraft $itemShippingDetailsDraft,
        $context = null
    ) {
        return static::of($context)->setLineItemId($lineItemId)->setShippingDetails($itemShippingDetailsDraft);
    }
}
