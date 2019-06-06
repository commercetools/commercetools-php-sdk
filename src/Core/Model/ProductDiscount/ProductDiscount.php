<?php
/**
 * @author @jenschude <jens.schulze@commercetools.de>
 */

namespace Commercetools\Core\Model\ProductDiscount;

use Commercetools\Core\Model\Common\CreatedBy;
use Commercetools\Core\Model\Common\LastModifiedBy;
use Commercetools\Core\Model\Common\Resource;
use Commercetools\Core\Model\Common\LocalizedString;
use Commercetools\Core\Model\Common\ReferenceCollection;
use Commercetools\Core\Model\Common\DateTimeDecorator;
use DateTime;

/**
 * @package Commercetools\Core\Model\ProductDiscount
 * @link https://docs.commercetools.com/http-api-projects-productDiscounts.html#productdiscount
 * @method string getId()
 * @method ProductDiscount setId(string $id = null)
 * @method int getVersion()
 * @method ProductDiscount setVersion(int $version = null)
 * @method DateTimeDecorator getCreatedAt()
 * @method ProductDiscount setCreatedAt(DateTime $createdAt = null)
 * @method DateTimeDecorator getLastModifiedAt()
 * @method ProductDiscount setLastModifiedAt(DateTime $lastModifiedAt = null)
 * @method LocalizedString getName()
 * @method ProductDiscount setName(LocalizedString $name = null)
 * @method LocalizedString getDescription()
 * @method ProductDiscount setDescription(LocalizedString $description = null)
 * @method ProductDiscountValue getValue()
 * @method ProductDiscount setValue(ProductDiscountValue $value = null)
 * @method mixed getPredicate()
 * @method ProductDiscount setPredicate($predicate = null)
 * @method string getSortOrder()
 * @method ProductDiscount setSortOrder(string $sortOrder = null)
 * @method bool getIsActive()
 * @method ProductDiscount setIsActive(bool $isActive = null)
 * @method ReferenceCollection getReferences()
 * @method ProductDiscount setReferences(ReferenceCollection $references = null)
 * @method DateTimeDecorator getValidFrom()
 * @method ProductDiscount setValidFrom(DateTime $validFrom = null)
 * @method DateTimeDecorator getValidUntil()
 * @method ProductDiscount setValidUntil(DateTime $validUntil = null)
 * @method CreatedBy getCreatedBy()
 * @method ProductDiscount setCreatedBy(CreatedBy $createdBy = null)
 * @method LastModifiedBy getLastModifiedBy()
 * @method ProductDiscount setLastModifiedBy(LastModifiedBy $lastModifiedBy = null)
 * @method string getKey()
 * @method ProductDiscount setKey(string $key = null)
 * @method ProductDiscountReference getReference()
 */
class ProductDiscount extends Resource
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
            'name' => [static::TYPE => LocalizedString::class],
            'key' => [static::TYPE => 'string'],
            'description' => [static::TYPE => LocalizedString::class],
            'value' => [static::TYPE => ProductDiscountValue::class],
            'predicate' => [],
            'sortOrder' => [static::TYPE => 'string'],
            'isActive' => [static::TYPE => 'bool'],
            'references' => [static::TYPE => ReferenceCollection::class],
            'validFrom' => [
                static::TYPE => DateTime::class,
                static::DECORATOR => DateTimeDecorator::class
            ],
            'validUntil' => [
                static::TYPE => DateTime::class,
                static::DECORATOR => DateTimeDecorator::class
            ],
            'createdBy' => [static::TYPE => CreatedBy::class],
            'lastModifiedBy' => [static::TYPE => LastModifiedBy::class],
        ];
    }
}
