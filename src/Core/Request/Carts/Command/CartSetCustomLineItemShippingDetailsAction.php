<?php
/**
 */

namespace Commercetools\Core\Request\Carts\Command;

use Commercetools\Core\Model\Cart\ItemShippingDetailsDraft;
use Commercetools\Core\Model\Common\Context;
use Commercetools\Core\Request\AbstractAction;

/**
 * @package Commercetools\Core\Request\Carts\Command
 * @link https://docs.commercetools.com/http-api-projects-carts.html#set-customlineitemshippingdetails
 * @method string getAction()
 * @method CartSetCustomLineItemShippingDetailsAction setAction(string $action = null)
 * @method string getCustomLineItemId()
 * @method CartSetCustomLineItemShippingDetailsAction setCustomLineItemId(string $customLineItemId = null)
 * @method ItemShippingDetailsDraft getShippingDetails()
 * phpcs:disable
 * @method CartSetCustomLineItemShippingDetailsAction setShippingDetails(ItemShippingDetailsDraft $shippingDetails = null)
 * phpcs:enable
 */
class CartSetCustomLineItemShippingDetailsAction extends AbstractAction
{
    public function fieldDefinitions()
    {
        return [
            'action' => [static::TYPE => 'string'],
            'customLineItemId' => [static::TYPE => 'string'],
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
        $this->setAction('setCustomLineItemShippingDetails');
    }

    /**
     * @param $customLineItemId
     * @param ItemShippingDetailsDraft $itemShippingDetailsDraft
     * @param Context|callable $context
     * @return CartSetCustomLineItemShippingDetailsAction
     */
    public static function ofCustomLineItemIdAndShippingDetails(
        $customLineItemId,
        ItemShippingDetailsDraft $itemShippingDetailsDraft,
        $context = null
    ) {
        return static::of($context)
            ->setCustomLineItemId($customLineItemId)
            ->setShippingDetails($itemShippingDetailsDraft);
    }
}
