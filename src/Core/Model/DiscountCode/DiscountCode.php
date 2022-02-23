<?php
/**
 * @author @jenschude <jens.schulze@commercetools.de>
 */

namespace Commercetools\Core\Model\DiscountCode;

use Commercetools\Core\Model\CartDiscount\CartDiscountReferenceCollection;
use Commercetools\Core\Model\Common\CreatedBy;
use Commercetools\Core\Model\Common\LastModifiedBy;
use Commercetools\Core\Model\Common\Resource;
use Commercetools\Core\Model\Common\LocalizedString;
use Commercetools\Core\Model\Common\ReferenceCollection;
use Commercetools\Core\Model\Common\DateTimeDecorator;
use Commercetools\Core\Model\CustomField\CustomFieldObject;
use DateTime;

/**
 * @package Commercetools\Core\Model\DiscountCode
 * @link https://docs.commercetools.com/http-api-projects-discountCodes.html#discountcode
 * @method string getId()
 * @method DiscountCode setId(string $id = null)
 * @method int getVersion()
 * @method DiscountCode setVersion(int $version = null)
 * @method DateTimeDecorator getCreatedAt()
 * @method DiscountCode setCreatedAt(DateTime $createdAt = null)
 * @method DateTimeDecorator getLastModifiedAt()
 * @method DiscountCode setLastModifiedAt(DateTime $lastModifiedAt = null)
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
 * @method CustomFieldObject getCustom()
 * @method DiscountCode setCustom(CustomFieldObject $custom = null)
 * @method array getGroups()
 * @method DiscountCode setGroups(array $groups = null)
 * @method DateTimeDecorator getValidFrom()
 * @method DiscountCode setValidFrom(DateTime $validFrom = null)
 * @method DateTimeDecorator getValidUntil()
 * @method DiscountCode setValidUntil(DateTime $validUntil = null)
 * @method CreatedBy getCreatedBy()
 * @method DiscountCode setCreatedBy(CreatedBy $createdBy = null)
 * @method LastModifiedBy getLastModifiedBy()
 * @method DiscountCode setLastModifiedBy(LastModifiedBy $lastModifiedBy = null)
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
                static::TYPE => DateTime::class,
                static::DECORATOR => DateTimeDecorator::class
            ],
            'lastModifiedAt' => [
                static::TYPE => DateTime::class,
                static::DECORATOR => DateTimeDecorator::class
            ],
            'name' => [static::TYPE => LocalizedString::class, static::OPTIONAL => true],
            'description' => [static::TYPE => LocalizedString::class, static::OPTIONAL => true],
            'code' => [static::TYPE => 'string'],
            'cartDiscounts' => [
                static::TYPE => CartDiscountReferenceCollection::class
            ],
            'cartPredicate' => [static::OPTIONAL => true],
            'isActive' => [static::TYPE => 'bool'],
            'references' => [static::TYPE => ReferenceCollection::class],
            'maxApplications' => [static::TYPE => 'int', static::OPTIONAL => true],
            'maxApplicationsPerCustomer' => [static::TYPE => 'int', static::OPTIONAL => true],
            'custom' => [static::TYPE => CustomFieldObject::class, static::OPTIONAL => true],
            'groups' => [static::TYPE => 'array'],
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
            'createdBy' => [static::TYPE => CreatedBy::class, static::OPTIONAL => true],
            'lastModifiedBy' => [static::TYPE => LastModifiedBy::class, static::OPTIONAL => true],
        ];
    }
}
