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
 * @link https://dev.commercetools.com/http-api-projects-cartDiscounts.html#cart-discount
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
                static::DECORATOR => '\Commercetools\Core\Model\Common\DateTimeDecorator'
            ],
            'lastModifiedAt' => [
                static::TYPE => '\DateTime',
                static::DECORATOR => '\Commercetools\Core\Model\Common\DateTimeDecorator'
            ],
            'name' => [static::TYPE => '\Commercetools\Core\Model\Common\LocalizedString'],
            'description' => [static::TYPE => '\Commercetools\Core\Model\Common\LocalizedString'],
            'value' => [static::TYPE => '\Commercetools\Core\Model\CartDiscount\CartDiscountValue'],
            'cartPredicate' => [static::TYPE => 'string'],
            'target' => [static::TYPE => '\Commercetools\Core\Model\CartDiscount\CartDiscountTarget'],
            'sortOrder' => [static::TYPE => 'string'],
            'isActive' => [static::TYPE => 'bool'],
            'validFrom' => [
                static::TYPE => '\DateTime',
                static::DECORATOR => '\Commercetools\Core\Model\Common\DateTimeDecorator'
            ],
            'validUntil' => [
                static::TYPE => '\DateTime',
                static::DECORATOR => '\Commercetools\Core\Model\Common\DateTimeDecorator'
            ],
            'requiresDiscountCode' => [static::TYPE => 'bool'],
            'references' => [static::TYPE => '\Commercetools\Core\Model\Common\ReferenceCollection']
        ];
    }
}
