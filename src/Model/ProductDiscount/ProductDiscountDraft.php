<?php
/**
 * @author @ct-jensschulze <jens.schulze@commercetools.de>
 */

namespace Commercetools\Core\Model\ProductDiscount;

use Commercetools\Core\Model\Common\Context;
use Commercetools\Core\Model\Common\JsonObject;
use Commercetools\Core\Model\Common\LocalizedString;

/**
 * @package Commercetools\Core\Model\ProductDiscount
 * @method LocalizedString getName()
 * @method ProductDiscountDraft setName(LocalizedString $name = null)
 * @method LocalizedString getDescription()
 * @method ProductDiscountDraft setDescription(LocalizedString $description = null)
 * @method ProductDiscountValue getValue()
 * @method ProductDiscountDraft setValue(ProductDiscountValue $value = null)
 * @method string getPredicate()
 * @method ProductDiscountDraft setPredicate(string $predicate = null)
 * @method string getSortOrder()
 * @method ProductDiscountDraft setSortOrder(string $sortOrder = null)
 * @method bool getIsActive()
 * @method ProductDiscountDraft setIsActive(bool $isActive = null)
 */
class ProductDiscountDraft extends JsonObject
{
    public function getPropertyDefinitions()
    {
        return [
            'name' => [static::TYPE => '\Commercetools\Core\Model\Common\LocalizedString'],
            'description' => [static::TYPE => '\Commercetools\Core\Model\Common\LocalizedString'],
            'value' => [static::TYPE => '\Commercetools\Core\Model\ProductDiscount\ProductDiscountValue'],
            'predicate' => [static::TYPE => 'string'],
            'sortOrder' => [static::TYPE => 'string'],
            'isActive' => [static::TYPE => 'bool'],
        ];
    }

    /**
     * @param LocalizedString $name
     * @param ProductDiscountValue $value
     * @param string $predicate
     * @param string $sortOrder
     * @param bool $isActive
     * @param Context|callable $context
     * @return ProductDiscountDraft
     */
    public static function ofNameDiscountPredicateOrderAndActive(
        LocalizedString $name,
        ProductDiscountValue $value,
        $predicate,
        $sortOrder,
        $isActive,
        $context = null
    ) {
        return static::of($context)
            ->setName($name)
            ->setValue($value)
            ->setPredicate($predicate)
            ->setSortOrder($sortOrder)
            ->setIsActive($isActive)
        ;
    }
}
