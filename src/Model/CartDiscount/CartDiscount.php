<?php
/**
 * @author @ct-jensschulze <jens.schulze@commercetools.de>
 */

namespace Sphere\Core\Model\CartDiscount;

use Sphere\Core\Model\Common\JsonObject;
use Sphere\Core\Model\Common\LocalizedString;
use Sphere\Core\Model\Common\ReferenceCollection;

/**
 * Class CartDiscount
 * @package Sphere\Core\Model\CartDiscount
 * @method string getId()
 * @method CartDiscount setId(string $id)
 * @method int getVersion()
 * @method CartDiscount setVersion(int $version)
 * @method \DateTime getCreatedAt()
 * @method CartDiscount setCreatedAt(\DateTime $createdAt)
 * @method \DateTime getLastModifiedAt()
 * @method CartDiscount setLastModifiedAt(\DateTime $lastModifiedAt)
 * @method LocalizedString getName()
 * @method CartDiscount setName(LocalizedString $name)
 * @method LocalizedString getDescription()
 * @method CartDiscount setDescription(LocalizedString $description)
 * @method CartDiscountValue getValue()
 * @method CartDiscount setValue(CartDiscountValue $value)
 * @method string getCartPredicate()
 * @method CartDiscount setCartPredicate(string $cartPredicate)
 * @method CartDiscountTarget getTarget()
 * @method CartDiscount setTarget(CartDiscountTarget $target)
 * @method string getSortOrder()
 * @method CartDiscount setSortOrder(string $sortOrder)
 * @method bool getIsActive()
 * @method CartDiscount setIsActive(bool $isActive)
 * @method \DateTime getValidFrom()
 * @method CartDiscount setValidFrom(\DateTime $validFrom)
 * @method \DateTime getValidUntil()
 * @method CartDiscount setValidUntil(\DateTime $validUntil)
 * @method bool getRequiresDiscountCode()
 * @method CartDiscount setRequiresDiscountCode(bool $requiresDiscountCode)
 * @method ReferenceCollection getReferences()
 * @method CartDiscount setReferences(ReferenceCollection $references)
 */
class CartDiscount extends JsonObject
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
