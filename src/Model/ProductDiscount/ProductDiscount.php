<?php
/**
 * @author @jayS-de <jens.schulze@commercetools.de>
 */

namespace Commercetools\Core\Model\ProductDiscount;

use Commercetools\Core\Model\Common\Resource;
use Commercetools\Core\Model\Common\LocalizedString;
use Commercetools\Core\Model\Common\ReferenceCollection;
use Commercetools\Core\Model\Common\DateTimeDecorator;

/**
 * @package Commercetools\Core\Model\ProductDiscount
 * @link https://dev.commercetools.com/http-api-projects-productDiscounts.html#product-discount
 * @method string getId()
 * @method ProductDiscount setId(string $id = null)
 * @method int getVersion()
 * @method ProductDiscount setVersion(int $version = null)
 * @method DateTimeDecorator getCreatedAt()
 * @method ProductDiscount setCreatedAt(\DateTime $createdAt = null)
 * @method DateTimeDecorator getLastModifiedAt()
 * @method ProductDiscount setLastModifiedAt(\DateTime $lastModifiedAt = null)
 * @method LocalizedString getName()
 * @method ProductDiscount setName(LocalizedString $name = null)
 * @method LocalizedString getDescription()
 * @method ProductDiscount setDescription(LocalizedString $description = null)
 * @method ProductDiscountValue getValue()
 * @method ProductDiscount setValue(ProductDiscountValue $value = null)
 * @method getPredicate()
 * @method ProductDiscount setPredicate($predicate = null)
 * @method string getSortOrder()
 * @method ProductDiscount setSortOrder(string $sortOrder = null)
 * @method bool getIsActive()
 * @method ProductDiscount setIsActive(bool $isActive = null)
 * @method ReferenceCollection getReferences()
 * @method ProductDiscount setReferences(ReferenceCollection $references = null)
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
                static::TYPE => '\DateTime',
                static::DECORATOR => '\Commercetools\Core\Model\Common\DateTimeDecorator'
            ],
            'lastModifiedAt' => [
                static::TYPE => '\DateTime',
                static::DECORATOR => '\Commercetools\Core\Model\Common\DateTimeDecorator'
            ],
            'name' => [static::TYPE => '\Commercetools\Core\Model\Common\LocalizedString'],
            'description' => [static::TYPE => '\Commercetools\Core\Model\Common\LocalizedString'],
            'value' => [static::TYPE => '\Commercetools\Core\Model\ProductDiscount\ProductDiscountValue'],
            'predicate' => [],
            'sortOrder' => [static::TYPE => 'string'],
            'isActive' => [static::TYPE => 'bool'],
            'references' => [static::TYPE => '\Commercetools\Core\Model\Common\ReferenceCollection'],
        ];
    }
}
