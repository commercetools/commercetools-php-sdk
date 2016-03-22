<?php
/**
 * @author @jayS-de <jens.schulze@commercetools.de>
 */

namespace Commercetools\Core\Model\ProductType;

use Commercetools\Core\Model\Common\Resource;
use Commercetools\Core\Model\Common\DateTimeDecorator;

/**
 * @package Commercetools\Core\Model\ProductType
 * @link https://dev.commercetools.com/http-api-projects-productTypes.html#product-type
 * @method string getId()
 * @method ProductType setId(string $id = null)
 * @method int getVersion()
 * @method ProductType setVersion(int $version = null)
 * @method DateTimeDecorator getCreatedAt()
 * @method ProductType setCreatedAt(\DateTime $createdAt = null)
 * @method DateTimeDecorator getLastModifiedAt()
 * @method ProductType setLastModifiedAt(\DateTime $lastModifiedAt = null)
 * @method string getName()
 * @method ProductType setName(string $name = null)
 * @method string getDescription()
 * @method ProductType setDescription(string $description = null)
 * @method AttributeDefinitionCollection getAttributes()
 * @method ProductType setAttributes(AttributeDefinitionCollection $attributes = null)
 * @method string getKey()
 * @method ProductType setKey(string $key = null)
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
                static::TYPE => '\DateTime',
                static::DECORATOR => '\Commercetools\Core\Model\Common\DateTimeDecorator'
            ],
            'lastModifiedAt' => [
                static::TYPE => '\DateTime',
                static::DECORATOR => '\Commercetools\Core\Model\Common\DateTimeDecorator'
            ],
            'key' => [static::TYPE => 'string'],
            'name' => [static::TYPE => 'string'],
            'description' => [static::TYPE => 'string'],
            'attributes' => [static::TYPE => '\Commercetools\Core\Model\ProductType\AttributeDefinitionCollection']
        ];
    }
}
