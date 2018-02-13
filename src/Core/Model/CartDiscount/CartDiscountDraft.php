<?php
/**
 * @author @jenschude <jens.schulze@commercetools.de>
 */

namespace Commercetools\Core\Model\CartDiscount;

use Commercetools\Core\Model\Common\Context;
use Commercetools\Core\Model\Common\JsonObject;
use Commercetools\Core\Model\Common\LocalizedString;
use Commercetools\Core\Model\Common\DateTimeDecorator;
use Commercetools\Core\Model\CustomField\CustomFieldObjectDraft;
use DateTime;

/**
 * @package Commercetools\Core\Model\CartDiscount
 * @link https://docs.commercetools.com/http-api-projects-cartDiscounts.html#cartdiscount
 * @method LocalizedString getName()
 * @method CartDiscountDraft setName(LocalizedString $name = null)
 * @method LocalizedString getDescription()
 * @method CartDiscountDraft setDescription(LocalizedString $description = null)
 * @method CartDiscountValue getValue()
 * @method CartDiscountDraft setValue(CartDiscountValue $value = null)
 * @method string getCartPredicate()
 * @method CartDiscountDraft setCartPredicate(string $cartPredicate = null)
 * @method CartDiscountTarget getTarget()
 * @method CartDiscountDraft setTarget(CartDiscountTarget $target = null)
 * @method string getSortOrder()
 * @method CartDiscountDraft setSortOrder(string $sortOrder = null)
 * @method bool getIsActive()
 * @method CartDiscountDraft setIsActive(bool $isActive = null)
 * @method DateTimeDecorator getValidFrom()
 * @method CartDiscountDraft setValidFrom(DateTime $validFrom = null)
 * @method DateTimeDecorator getValidUntil()
 * @method CartDiscountDraft setValidUntil(DateTime $validUntil = null)
 * @method bool getRequiresDiscountCode()
 * @method CartDiscountDraft setRequiresDiscountCode(bool $requiresDiscountCode = null)
 * @method string getStackingMode()
 * @method CartDiscountDraft setStackingMode(string $stackingMode = null)
 * @method CustomFieldObjectDraft getCustom()
 * @method CartDiscountDraft setCustom(CustomFieldObjectDraft $custom = null)
 */
class CartDiscountDraft extends JsonObject
{
    const NAME = 'name';
    const DESCRIPTION = 'description';
    const VALUE = 'value';
    const CART_PREDICATE = 'cartPredicate';
    const TARGET = 'target';
    const SORT_ORDER = 'sortOrder';
    const IS_ACTIVE = 'isActive';
    const VALID_FROM = 'validFrom';
    const VALID_UNTIL = 'validUntil';
    const REQUIRES_DISCOUNT_CODE = 'requiresDiscountCode';
    const STACKING_MODE = 'stackingMode';
    const CUSTOM = 'custom';

    public function fieldDefinitions()
    {
        return [
            static::NAME => [static::TYPE => LocalizedString::class],
            static::DESCRIPTION => [static::TYPE => LocalizedString::class],
            static::VALUE => [static::TYPE => CartDiscountValue::class],
            static::CART_PREDICATE => [static::TYPE => 'string'],
            static::TARGET => [static::TYPE => CartDiscountTarget::class],
            static::SORT_ORDER => [static::TYPE => 'string'],
            static::IS_ACTIVE => [static::TYPE => 'bool'],
            static::VALID_FROM => [
                static::TYPE => DateTime::class,
                static::DECORATOR => DateTimeDecorator::class
            ],
            static::VALID_UNTIL  => [
                static::TYPE => DateTime::class,
                static::DECORATOR => DateTimeDecorator::class
            ],
            static::REQUIRES_DISCOUNT_CODE => [static::TYPE => 'bool'],
            static::STACKING_MODE => [static::TYPE => 'string'],
            static::CUSTOM => [static::TYPE => CustomFieldObjectDraft::class]
        ];
    }

    /**
     * @param LocalizedString $name
     * @param CartDiscountValue $value
     * @param string $cartPredicate
     * @param CartDiscountTarget $target
     * @param string $sortOrder
     * @param bool $isActive
     * @param bool $requiresDiscountCode
     * @param Context|callable $context
     * @return CartDiscountDraft
     */
    public static function ofNameValuePredicateTargetOrderActiveAndDiscountCode(
        LocalizedString $name,
        CartDiscountValue $value,
        $cartPredicate,
        CartDiscountTarget $target,
        $sortOrder,
        $isActive,
        $requiresDiscountCode,
        $context = null
    ) {
        $draft = static::of($context);
        return $draft->setName($name)
            ->setValue($value)
            ->setCartPredicate($cartPredicate)
            ->setTarget($target)
            ->setSortOrder($sortOrder)
            ->setIsActive($isActive)
            ->setRequiresDiscountCode($requiresDiscountCode);
    }

    /**
     * @param LocalizedString $name
     * @param CartDiscountValue $value
     * @param string $cartPredicate
     * @param string $sortOrder
     * @param bool $isActive
     * @param bool $requiresDiscountCode
     * @param Context|callable $context
     * @return CartDiscountDraft
     */
    public static function ofNameValuePredicateOrderActiveAndDiscountCode(
        LocalizedString $name,
        CartDiscountValue $value,
        $cartPredicate,
        $sortOrder,
        $isActive,
        $requiresDiscountCode,
        $context = null
    ) {
        $draft = static::of($context);
        return $draft->setName($name)
            ->setValue($value)
            ->setCartPredicate($cartPredicate)
            ->setSortOrder($sortOrder)
            ->setIsActive($isActive)
            ->setRequiresDiscountCode($requiresDiscountCode);
    }
}
