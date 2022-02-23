<?php
/**
 * @author @jenschude <jens.schulze@commercetools.de>
 */

namespace Commercetools\Core\Model\DiscountCode;

use Commercetools\Core\Model\CartDiscount\CartDiscountReferenceCollection;
use Commercetools\Core\Model\Common\Context;
use Commercetools\Core\Model\Common\DateTimeDecorator;
use Commercetools\Core\Model\Common\JsonObject;
use Commercetools\Core\Model\Common\LocalizedString;
use Commercetools\Core\Model\CustomField\CustomFieldObjectDraft;
use DateTime;

/**
 * @package Commercetools\Core\Model\DiscountCode
 * @link https://docs.commercetools.com/http-api-projects-discountCodes.html#discountcodedraft
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
 * @method DateTimeDecorator getValidFrom()
 * @method DiscountCodeDraft setValidFrom(DateTime $validFrom = null)
 * @method DateTimeDecorator getValidUntil()
 * @method DiscountCodeDraft setValidUntil(DateTime $validUntil = null)
 */
class DiscountCodeDraft extends JsonObject
{
    public function fieldDefinitions()
    {
        return [
            'name' => [static::TYPE => LocalizedString::class, static::OPTIONAL => true],
            'description' => [static::TYPE => LocalizedString::class, static::OPTIONAL => true],
            'code' => [static::TYPE => 'string'],
            'cartDiscounts' => [
                static::TYPE => CartDiscountReferenceCollection::class
            ],
            'cartPredicate' => [static::TYPE => 'string', static::OPTIONAL => true],
            'isActive' => [static::TYPE => 'bool', static::OPTIONAL => true],
            'maxApplications' => [static::TYPE => 'int', static::OPTIONAL => true],
            'maxApplicationsPerCustomer' => [static::TYPE => 'int', static::OPTIONAL => true],
            'custom' => [static::TYPE => CustomFieldObjectDraft::class, static::OPTIONAL => true],
            'groups' => [static::TYPE => 'array', static::OPTIONAL => true],
            'validFrom' => [
                static::TYPE => DateTime::class,
                static::OPTIONAL => true,
                static::DECORATOR => DateTimeDecorator::class
            ],
            'validUntil' => [
                static::TYPE => DateTime::class,
                static::OPTIONAL => true,
                static::DECORATOR => DateTimeDecorator::class
            ],
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
