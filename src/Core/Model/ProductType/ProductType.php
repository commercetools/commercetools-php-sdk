<?php
/**
 * @author @jenschude <jens.schulze@commercetools.de>
 */

namespace Commercetools\Core\Model\ProductType;

use Commercetools\Core\Model\Common\CreatedBy;
use Commercetools\Core\Model\Common\LastModifiedBy;
use Commercetools\Core\Model\Common\Resource;
use Commercetools\Core\Model\Common\DateTimeDecorator;
use DateTime;

/**
 * @package Commercetools\Core\Model\ProductType
 * @link https://docs.commercetools.com/http-api-projects-productTypes.html#producttype
 * @method string getId()
 * @method ProductType setId(string $id = null)
 * @method int getVersion()
 * @method ProductType setVersion(int $version = null)
 * @method DateTimeDecorator getCreatedAt()
 * @method ProductType setCreatedAt(DateTime $createdAt = null)
 * @method DateTimeDecorator getLastModifiedAt()
 * @method ProductType setLastModifiedAt(DateTime $lastModifiedAt = null)
 * @method string getName()
 * @method ProductType setName(string $name = null)
 * @method string getDescription()
 * @method ProductType setDescription(string $description = null)
 * @method AttributeDefinitionCollection getAttributes()
 * @method ProductType setAttributes(AttributeDefinitionCollection $attributes = null)
 * @method string getKey()
 * @method ProductType setKey(string $key = null)
 * @method CreatedBy getCreatedBy()
 * @method ProductType setCreatedBy(CreatedBy $createdBy = null)
 * @method LastModifiedBy getLastModifiedBy()
 * @method ProductType setLastModifiedBy(LastModifiedBy $lastModifiedBy = null)
 * @method ProductTypeReference getReference()
 */
class ProductType extends Resource
{
    /**
     * @return array
     */
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
            'key' => [static::TYPE => 'string'],
            'name' => [static::TYPE => 'string'],
            'description' => [static::TYPE => 'string'],
            'attributes' => [static::TYPE => AttributeDefinitionCollection::class],
            'createdBy' => [static::TYPE => CreatedBy::class],
            'lastModifiedBy' => [static::TYPE => LastModifiedBy::class],
        ];
    }
}
