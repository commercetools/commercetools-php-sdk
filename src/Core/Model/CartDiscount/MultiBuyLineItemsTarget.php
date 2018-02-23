<?php
/**
 * @author @jenschude <jens.schulze@commercetools.de>
 */

namespace Commercetools\Core\Model\CartDiscount;

/**
 * @package Commercetools\Core\Model\CartDiscount
 *
 * @method string getType()
 * @method MultiBuyLineItemsTarget setType(string $type = null)
 * @method string getPredicate()
 * @method MultiBuyLineItemsTarget setPredicate(string $predicate = null)
 * @method int getTriggerQuantity()
 * @method MultiBuyLineItemsTarget setTriggerQuantity(int $triggerQuantity = null)
 * @method int getDiscountedQuantity()
 * @method MultiBuyLineItemsTarget setDiscountedQuantity(int $discountedQuantity = null)
 * @method int getMaxOccurrence()
 * @method MultiBuyLineItemsTarget setMaxOccurrence(int $maxOccurrence = null)
 * @method string getSelectionMode()
 * @method MultiBuyLineItemsTarget setSelectionMode(string $selectionMode = null)
 */
class MultiBuyLineItemsTarget extends CartDiscountTarget
{
    const TARGET_TYPE = 'multiBuyLineItems';
    const MODE_CHEAPEST = 'Cheapest';
    const MODE_MOST_EXPENSIVE = 'MostExpensive';

    public function fieldDefinitions()
    {
        return [
            'type' => [static::TYPE => 'string'],
            'predicate' => [static::TYPE => 'string'],
            'triggerQuantity' => [static::TYPE => 'int'],
            'discountedQuantity' => [static::TYPE => 'int'],
            'maxOccurrence' => [static::TYPE => 'int'],
            'selectionMode' => [static::TYPE => 'string'],
        ];
    }

    public static function ofPredicateTriggerDiscountedAndMode(
        $predicate,
        $triggerQuantity,
        $discountedQuantity,
        $selectionMode,
        $context = null
    ) {
        return static::of($context)
            ->setPredicate($predicate)
            ->setTriggerQuantity($triggerQuantity)
            ->setDiscountedQuantity($discountedQuantity)
            ->setSelectionMode($selectionMode);
    }
}
