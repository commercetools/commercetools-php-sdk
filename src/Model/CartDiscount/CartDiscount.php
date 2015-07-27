<?php
/**
 * @author @ct-jensschulze <jens.schulze@commercetools.de>
 */

namespace Sphere\Core\Model\CartDiscount;

use Sphere\Core\Model\Common\Resource;
use Sphere\Core\Model\Common\LocalizedString;
use Sphere\Core\Model\Common\ReferenceCollection;

/**
 * @package Sphere\Core\Model\CartDiscount
 * @link http://dev.sphere.io/http-api-projects-cartDiscounts.html#cart-discount
 * @method string getId()
 * @method CartDiscount setId(string $id = null)
 * @method int getVersion()
 * @method CartDiscount setVersion(int $version = null)
 * @method \DateTime getCreatedAt()
 * @method CartDiscount setCreatedAt(\DateTime $createdAt = null)
 * @method \DateTime getLastModifiedAt()
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
 * @method \DateTime getValidFrom()
 * @method CartDiscount setValidFrom(\DateTime $validFrom = null)
 * @method \DateTime getValidUntil()
 * @method CartDiscount setValidUntil(\DateTime $validUntil = null)
 * @method bool getRequiresDiscountCode()
 * @method CartDiscount setRequiresDiscountCode(bool $requiresDiscountCode = null)
 * @method ReferenceCollection getReferences()
 * @method CartDiscount setReferences(ReferenceCollection $references = null)
 */
class CartDiscount extends Resource
{
    public function getFields()
    {
        return [
            'id' => [static::TYPE => 'string'],
            'version' => [static::TYPE => 'int'],
            'createdAt' => [static::TYPE => '\DateTime'],
            'lastModifiedAt' => [static::TYPE => '\DateTime'],
            'name' => [static::TYPE => '\Sphere\Core\Model\Common\LocalizedString'],
            'description' => [static::TYPE => '\Sphere\Core\Model\Common\LocalizedString'],
            'value' => [static::TYPE => '\Sphere\Core\Model\CartDiscount\CartDiscountValue'],
            'cartPredicate' => [static::TYPE => 'string'],
            'target' => [static::TYPE => '\Sphere\Core\Model\CartDiscount\CartDiscountTarget'],
            'sortOrder' => [static::TYPE => 'string'],
            'isActive' => [static::TYPE => 'bool'],
            'validFrom' => [static::TYPE => '\DateTime'],
            'validUntil' => [static::TYPE => '\DateTime'],
            'requiresDiscountCode' => [static::TYPE => 'bool'],
            'references' => [static::TYPE => '\Sphere\Core\Model\Common\ReferenceCollection']
        ];
    }
}
