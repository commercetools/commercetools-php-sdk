<?php
/**
 * @author @jayS-de <jens.schulze@commercetools.de>
 */

namespace Commercetools\Core\Model\DiscountCode;

use Commercetools\Core\Model\CartDiscount\CartDiscountReferenceCollection;
use Commercetools\Core\Model\Common\Context;
use Commercetools\Core\Model\Common\JsonObject;
use Commercetools\Core\Model\Common\LocalizedString;
use Commercetools\Core\Model\CustomField\CustomFieldObjectDraft;

/**
 * @package Commercetools\Core\Model\DiscountCode
 * @link https://dev.commercetools.com/http-api-projects-discountCodes.html#discountcodedraft
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
 * @method CustomFieldObjectDraft getCustom()
 * @method DiscountCodeDraft setCustom(CustomFieldObjectDraft $custom = null)
 * @method array getGroups()
 * @method DiscountCodeDraft setGroups(array $groups = null)
 */
class DiscountCodeDraft extends JsonObject
{
    public function fieldDefinitions()
    {
        return [
            'name' => [static::TYPE => LocalizedString::class],
            'description' => [static::TYPE => LocalizedString::class],
            'code' => [static::TYPE => 'string'],
            'cartDiscounts' => [
                static::TYPE => CartDiscountReferenceCollection::class
            ],
            'cartPredicate' => [static::TYPE => 'string'],
            'isActive' => [static::TYPE => 'bool'],
            'maxApplications' => [static::TYPE => 'int'],
            'maxApplicationsPerCustomer' => [static::TYPE => 'int'],
            'custom' => [static::TYPE => CustomFieldObjectDraft::class],
            'groups' => [static::TYPE => 'array'],
        ];
    }

    /**
     * @param string $code
     * @param CartDiscountReferenceCollection $cartDiscounts
     * @param bool $isActive
     * @param Context|callable $context
     * @return DiscountCodeDraft
     */
    public static function ofCodeDiscountsAndActive(
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
