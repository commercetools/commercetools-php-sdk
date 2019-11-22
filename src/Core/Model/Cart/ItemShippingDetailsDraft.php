<?php
/**
 *
 */

namespace Commercetools\Core\Model\Cart;

use Commercetools\Core\Model\Common\Context;
use Commercetools\Core\Model\Common\JsonObject;

/**
 * @package Commercetools\Core\Model\Cart
 *
 * @method ItemShippingTargetCollection getTargets()
 * @method ItemShippingDetailsDraft setTargets(ItemShippingTargetCollection $targets = null)
 */
class ItemShippingDetailsDraft extends JsonObject
{
    public function fieldDefinitions()
    {
        return [
            'targets' => [static::TYPE => ItemShippingTargetCollection::class],
        ];
    }

    /**
     * @param ItemShippingTargetCollection $targets[]
     * @param Context|callable $context
     * @return ItemShippingDetailsDraft
     */
    public static function ofTargets(ItemShippingTargetCollection $targets, $context = null)
    {
        return static::of($context)->setTargets($targets);
    }
}
