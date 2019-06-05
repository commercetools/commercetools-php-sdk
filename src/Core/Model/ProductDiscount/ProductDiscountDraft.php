<?php
/**
 * @author @jenschude <jens.schulze@commercetools.de>
 */

namespace Commercetools\Core\Model\ProductDiscount;

use Commercetools\Core\Model\Common\Context;
use Commercetools\Core\Model\Common\DateTimeDecorator;
use Commercetools\Core\Model\Common\JsonObject;
use Commercetools\Core\Model\Common\LocalizedString;
use DateTime;

/**
 * @package Commercetools\Core\Model\ProductDiscount
 * @link https://docs.commercetools.com/http-api-projects-productDiscounts.html#productdiscountdraft
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
 * @method DateTimeDecorator getValidFrom()
 * @method ProductDiscountDraft setValidFrom(DateTime $validFrom = null)
 * @method DateTimeDecorator getValidUntil()
 * @method ProductDiscountDraft setValidUntil(DateTime $validUntil = null)
 * @method string getKey()
 * @method ProductDiscountDraft setKey(string $key = null)
 */
class ProductDiscountDraft extends JsonObject
{
    public function fieldDefinitions()
    {
        return [
            'name' => [static::TYPE => LocalizedString::class],
            'key' => [static::TYPE => 'string'],
            'description' => [static::TYPE => LocalizedString::class],
            'value' => [static::TYPE => ProductDiscountValue::class],
            'predicate' => [static::TYPE => 'string'],
            'sortOrder' => [static::TYPE => 'string'],
            'isActive' => [static::TYPE => 'bool'],
            'validFrom' => [
                static::TYPE => DateTime::class,
                static::DECORATOR => DateTimeDecorator::class
            ],
            'validUntil' => [
                static::TYPE => DateTime::class,
                static::DECORATOR => DateTimeDecorator::class
            ],
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
