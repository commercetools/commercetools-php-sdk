<?php
/**
 * @author @jayS-de <jens.schulze@commercetools.de>
 */

namespace Commercetools\Core\Model\DiscountCode;

use Commercetools\Core\Model\CartDiscount\CartDiscountReferenceCollection;
use Commercetools\Core\Model\Common\Resource;
use Commercetools\Core\Model\Common\LocalizedString;
use Commercetools\Core\Model\Common\ReferenceCollection;
use Commercetools\Core\Model\Common\DateTimeDecorator;

/**
 * @package Commercetools\Core\Model\DiscountCode
 * @link https://dev.commercetools.com/http-api-projects-discountCodes.html#discountcode
 * @method string getId()
 * @method DiscountCode setId(string $id = null)
 * @method int getVersion()
 * @method DiscountCode setVersion(int $version = null)
 * @method DateTimeDecorator getCreatedAt()
 * @method DiscountCode setCreatedAt(\DateTime $createdAt = null)
 * @method DateTimeDecorator getLastModifiedAt()
 * @method DiscountCode setLastModifiedAt(\DateTime $lastModifiedAt = null)
 * @method LocalizedString getName()
 * @method DiscountCode setName(LocalizedString $name = null)
 * @method LocalizedString getDescription()
 * @method DiscountCode setDescription(LocalizedString $description = null)
 * @method string getCode()
 * @method DiscountCode setCode(string $code = null)
 * @method CartDiscountReferenceCollection getCartDiscounts()
 * @method DiscountCode setCartDiscounts(CartDiscountReferenceCollection $cartDiscounts = null)
 * @method mixed getCartPredicate()
 * @method DiscountCode setCartPredicate($cartPredicate = null)
 * @method bool getIsActive()
 * @method DiscountCode setIsActive(bool $isActive = null)
 * @method ReferenceCollection getReferences()
 * @method DiscountCode setReferences(ReferenceCollection $references = null)
 * @method int getMaxApplications()
 * @method DiscountCode setMaxApplications(int $maxApplications = null)
 * @method int getMaxApplicationsPerCustomer()
 * @method DiscountCode setMaxApplicationsPerCustomer(int $maxApplicationsPerCustomer = null)
 * @method DiscountCodeReference getReference()
 */
class DiscountCode extends Resource
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
            'code' => [static::TYPE => 'string'],
            'cartDiscounts' => [
                static::TYPE => CartDiscountReferenceCollection::class
            ],
            'cartPredicate' => [],
            'isActive' => [static::TYPE => 'bool'],
            'references' => [static::TYPE => ReferenceCollection::class],
            'maxApplications' => [static::TYPE => 'int'],
            'maxApplicationsPerCustomer' => [static::TYPE => 'int'],
        ];
    }
}
