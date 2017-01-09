<?php
/**
 * @author @jayS-de <jens.schulze@commercetools.de>
 */

namespace Commercetools\Core\Model\CartDiscount;

use Commercetools\Core\Model\Common\Resource;
use Commercetools\Core\Model\Common\LocalizedString;
use Commercetools\Core\Model\Common\ReferenceCollection;
use Commercetools\Core\Model\Common\DateTimeDecorator;

/**
 * @package Commercetools\Core\Model\CartDiscount
 * @link https://dev.commercetools.com/http-api-projects-cartDiscounts.html#cartdiscount
 * @method string getId()
 * @method CartDiscount setId(string $id = null)
 * @method int getVersion()
 * @method CartDiscount setVersion(int $version = null)
 * @method DateTimeDecorator getCreatedAt()
 * @method CartDiscount setCreatedAt(\DateTime $createdAt = null)
 * @method DateTimeDecorator getLastModifiedAt()
 * @method CartDiscount setLastModifiedAt(\DateTime $lastModifiedAt = null)
 * @method LocalizedString getName()
 * @method CartDiscount setName(LocalizedString $name = null)
 * @method LocalizedString getDescription()
 * @method CartDiscount setDescription(LocalizedString $description = null)
 * @method CartDiscountValue getValue()
 * @method CartDiscount setValue(CartDiscountValue $value = null)
 * @method string getCartPredicate()
 * @method CartDiscount setCartPredicate(string $cartPredicate = null)
 * @method CartDiscountTarget getTarget()
 * @method CartDiscount setTarget(CartDiscountTarget $target = null)
 * @method string getSortOrder()
 * @method CartDiscount setSortOrder(string $sortOrder = null)
 * @method bool getIsActive()
 * @method CartDiscount setIsActive(bool $isActive = null)
 * @method DateTimeDecorator getValidFrom()
 * @method CartDiscount setValidFrom(\DateTime $validFrom = null)
 * @method DateTimeDecorator getValidUntil()
 * @method CartDiscount setValidUntil(\DateTime $validUntil = null)
 * @method bool getRequiresDiscountCode()
 * @method CartDiscount setRequiresDiscountCode(bool $requiresDiscountCode = null)
 * @method ReferenceCollection getReferences()
 * @method CartDiscount setReferences(ReferenceCollection $references = null)
 * @method CartDiscountReference getReference()
 */
class CartDiscount extends Resource
{
    public function fieldDefinitions()
    {
        return [
            'id' => [static::TYPE => 'string'],
            'version' => [static::TYPE => 'int'],
            'createdAt' => [
                static::TYPE => '\DateTime',
                static::DECORATOR => DateTimeDecorator::class
            ],
            'lastModifiedAt' => [
                static::TYPE => '\DateTime',
                static::DECORATOR => DateTimeDecorator::class
            ],
            'name' => [static::TYPE => LocalizedString::class],
            'description' => [static::TYPE => LocalizedString::class],
            'value' => [static::TYPE => CartDiscountValue::class],
            'cartPredicate' => [static::TYPE => 'string'],
            'target' => [static::TYPE => CartDiscountTarget::class],
            'sortOrder' => [static::TYPE => 'string'],
            'isActive' => [static::TYPE => 'bool'],
            'validFrom' => [
                static::TYPE => '\DateTime',
                static::DECORATOR => DateTimeDecorator::class
            ],
            'validUntil' => [
                static::TYPE => '\DateTime',
                static::DECORATOR => DateTimeDecorator::class
            ],
            'requiresDiscountCode' => [static::TYPE => 'bool'],
            'references' => [static::TYPE => ReferenceCollection::class]
        ];
    }
}
