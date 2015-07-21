<?php
/**
 * @author @ct-jensschulze <jens.schulze@commercetools.de>
 */

namespace Sphere\Core\Model\DiscountCode;

use Sphere\Core\Model\CartDiscount\CartDiscountReferenceCollection;
use Sphere\Core\Model\Common\Context;
use Sphere\Core\Model\Common\JsonObject;
use Sphere\Core\Model\Common\LocalizedString;

/**
 * @package Sphere\Core\Model\DiscountCode
 * @method LocalizedString getName()
 * @method DiscountCodeDraft setName(LocalizedString $name = null)
 * @method LocalizedString getDescription()
 * @method DiscountCodeDraft setDescription(LocalizedString $description = null)
 * @method string getCode()
 * @method DiscountCodeDraft setCode(string $code = null)
 * @method CartDiscountReferenceCollection getCartDiscounts()
 * @method DiscountCodeDraft setCartDiscounts(CartDiscountReferenceCollection $cartDiscounts = null)
 * @method string getCartPredicate()
 * @method DiscountCodeDraft setCartPredicate(string $cartPredicate = null)
 * @method bool getIsActive()
 * @method DiscountCodeDraft setIsActive(bool $isActive = null)
 * @method int getMaxApplications()
 * @method DiscountCodeDraft setMaxApplications(int $maxApplications = null)
 * @method int getMaxApplicationsPerCustomer()
 * @method DiscountCodeDraft setMaxApplicationsPerCustomer(int $maxApplicationsPerCustomer = null)
 */
class DiscountCodeDraft extends JsonObject
{
    public function getFields()
    {
        return [
            'name' => [static::TYPE => '\Sphere\Core\Model\Common\LocalizedString'],
            'description' => [static::TYPE => '\Sphere\Core\Model\Common\LocalizedString'],
            'code' => [static::TYPE => 'string'],
            'cartDiscounts' => [static::TYPE => '\Sphere\Core\Model\CartDiscount\CartDiscountReferenceCollection'],
            'cartPredicate' => [static::TYPE => 'string'],
            'isActive' => [static::TYPE => 'bool'],
            'maxApplications' => [static::TYPE => 'int'],
            'maxApplicationsPerCustomer' => [static::TYPE => 'int'],
        ];
    }

    /**
     * @param string $code
     * @param CartDiscountReferenceCollection $cartDiscounts
     * @param bool $isActive
     * @param Context|callable $context
     * @return DiscountCodeDraft
     */
    public function ofCodeDiscountsAndActive(
        $code,
        CartDiscountReferenceCollection $cartDiscounts,
        $isActive,
        $context = null
    ) {
        return static::of($context)
            ->setCode($code)
            ->setCartDiscounts($cartDiscounts)
            ->setIsActive($isActive);
    }
}
