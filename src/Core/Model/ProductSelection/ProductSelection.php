<?php

namespace Commercetools\Core\Model\ProductSelection;

use Commercetools\Core\Model\Common\CreatedBy;
use Commercetools\Core\Model\Common\DateTimeDecorator;
use Commercetools\Core\Model\Common\LastModifiedBy;
use Commercetools\Core\Model\Common\LocalizedString;
use Commercetools\Core\Model\Common\Resource;
use DateTime;

/**
 * @package Commercetools\Core\Model\ProductSelection
 * @link https://docs.commercetools.com/api/projects/product-selections#productselection
 * @method string getId()
 * @method ProductSelection setId(string $id = null)
 * @method int getVersion()
 * @method ProductSelection setVersion(int $version = null)
 * @method string getKey()
 * @method ProductSelection setKey(string $key = null)
 * @method DateTimeDecorator getCreatedAt()
 * @method ProductSelection setCreatedAt(DateTime $createdAt = null)
 * @method DateTimeDecorator getLastModifiedAt()
 * @method ProductSelection setLastModifiedAt(DateTime $lastModifiedAt = null)
 * @method LastModifiedBy getLastModifiedBy()
 * @method ProductSelection setLastModifiedBy(LastModifiedBy $lastModifiedBy = null)
 * @method CreatedBy getCreatedBy()
 * @method ProductSelection setCreatedBy(CreatedBy $createdBy = null)
 * @method LocalizedString getName()
 * @method ProductSelection setName(LocalizedString $name = null)
 * @method int getProductCount()
 * @method ProductSelection setProductCount(int $productCount = null)
 * @method ProductSelectionType getType()
 * @method ProductSelection setType(ProductSelectionType $type = null)
 * @method ProductSelectionReference getReference()
 */
class ProductSelection extends Resource
{
    public function fieldDefinitions()
    {
        return [
            'id' => [static::TYPE => 'string'],
            'version' => [static::TYPE => 'int'],
            'key' => [static::TYPE => 'string', static::OPTIONAL => true],
            'createdAt' => [
                static::TYPE => DateTime::class,
                static::DECORATOR => DateTimeDecorator::class
            ],
            'lastModifiedAt' => [
                static::TYPE => DateTime::class,
                static::DECORATOR => DateTimeDecorator::class
            ],
            'lastModifiedBy' => [static::TYPE => LastModifiedBy::class, static::OPTIONAL => true],
            'createdBy' => [static::TYPE => CreatedBy::class, static::OPTIONAL => true],
            'name' => [static::TYPE => LocalizedString::class],
            'productCount' => [static::TYPE => 'int'],
            'type' => [static::TYPE => ProductSelectionType::class]
        ];
    }
}
