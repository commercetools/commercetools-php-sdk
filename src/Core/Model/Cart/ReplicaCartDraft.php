<?php
/**
 * @author @jenschude <jens.schulze@commercetools.de>
 */

namespace Commercetools\Core\Model\Cart;

use Commercetools\Core\Model\Common\Context;
use Commercetools\Core\Model\Common\JsonObject;
use Commercetools\Core\Model\Common\LocaleTrait;
use Commercetools\Core\Model\Common\Reference;
use Commercetools\Core\Model\CustomerGroup\CustomerGroupReference;
use Commercetools\Core\Model\CustomField\CustomFieldObjectDraft;
use Commercetools\Core\Model\Common\Address;
use Commercetools\Core\Model\Order\OrderReference;
use Commercetools\Core\Model\ShippingMethod\ShippingMethodReference;
use Commercetools\Core\Model\TaxCategory\ExternalTaxRateDraft;

/**
 * @package Commercetools\Core\Model\Cart
 * @link https://docs.commercetools.com/http-api-projects-carts.html#replicacartdraft
 * @method Reference getReference()
 * @method ReplicaCartDraft setReference(Reference $reference = null)
 */
class ReplicaCartDraft extends JsonObject
{
    public function fieldDefinitions()
    {
        return [
            'reference' => [static::TYPE => Reference::class]
        ];
    }

    /**
     * @param OrderReference $order
     * @param Context|callable $context
     * @return ReplicaCartDraft
     */
    public static function ofOrder(OrderReference $order, $context = null)
    {
        return static::of($context)->setReference($order);
    }


    /**
     * @param CartReference $cart
     * @param Context|callable $context
     * @return ReplicaCartDraft
     */
    public static function ofCart(CartReference $cart, $context = null)
    {
        return static::of($context)->setReference($cart);
    }
}
