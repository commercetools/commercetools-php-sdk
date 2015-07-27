<?php
/**
 * @author @ct-jensschulze <jens.schulze@commercetools.de>
 */

namespace Sphere\Core\Model\DiscountCode;

use Sphere\Core\Model\CartDiscount\CartDiscountReferenceCollection;
use Sphere\Core\Model\Common\Resource;
use Sphere\Core\Model\Common\LocalizedString;
use Sphere\Core\Model\Common\ReferenceCollection;

/**
 * @package Sphere\Core\Model\DiscountCode
 * @link http://dev.sphere.io/http-api-projects-discountCodes.html#discount-code
 * @method string getId()
 * @method DiscountCode setId(string $id = null)
 * @method int getVersion()
 * @method DiscountCode setVersion(int $version = null)
 * @method \DateTime getCreatedAt()
 * @method DiscountCode setCreatedAt(\DateTime $createdAt = null)
 * @method \DateTime getLastModifiedAt()
 * @method DiscountCode setLastModifiedAt(\DateTime $lastModifiedAt = null)
 * @method LocalizedString getName()
 * @method DiscountCode setName(LocalizedString $name = null)
 * @method LocalizedString getDescription()
 * @method DiscountCode setDescription(LocalizedString $description = null)
 * @method string getCode()
 * @method DiscountCode setCode(string $code = null)
 * @method CartDiscountReferenceCollection getCartDiscounts()
 * @method DiscountCode setCartDiscounts(CartDiscountReferenceCollection $cartDiscounts = null)
 * @method getCartPredicate()
 * @method DiscountCode setCartPredicate($cartPredicate = null)
 * @method bool getIsActive()
 * @method DiscountCode setIsActive(bool $isActive = null)
 * @method ReferenceCollection getReferences()
 * @method DiscountCode setReferences(ReferenceCollection $references = null)
 * @method int getMaxApplications()
 * @method DiscountCode setMaxApplications(int $maxApplications = null)
 * @method int getMaxApplicationsPerCustomer()
 * @method DiscountCode setMaxApplicationsPerCustomer(int $maxApplicationsPerCustomer = null)
 */
class DiscountCode extends Resource
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
            'code' => [static::TYPE => 'string'],
            'cartDiscounts' => [static::TYPE => '\Sphere\Core\Model\CartDiscount\CartDiscountReferenceCollection'],
            'cartPredicate' => [],
            'isActive' => [static::TYPE => 'bool'],
            'references' => [static::TYPE => '\Sphere\Core\Model\Common\ReferenceCollection'],
            'maxApplications' => [static::TYPE => 'int'],
            'maxApplicationsPerCustomer' => [static::TYPE => 'int'],
        ];
    }
}
