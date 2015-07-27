<?php
/**
 * @author @ct-jensschulze <jens.schulze@commercetools.de>
 */

namespace Sphere\Core\Model\ProductType;

use Sphere\Core\Model\Common\Resource;

/**
 * @package Sphere\Core\Model\ProductType
 * @link http://dev.sphere.io/http-api-projects-productTypes.html#product-type
 * @method string getId()
 * @method ProductType setId(string $id = null)
 * @method int getVersion()
 * @method ProductType setVersion(int $version = null)
 * @method \DateTime getCreatedAt()
 * @method ProductType setCreatedAt(\DateTime $createdAt = null)
 * @method \DateTime getLastModifiedAt()
 * @method ProductType setLastModifiedAt(\DateTime $lastModifiedAt = null)
 * @method string getName()
 * @method ProductType setName(string $name = null)
 * @method string getDescription()
 * @method ProductType setDescription(string $description = null)
 * @method AttributeDefinitionCollection getAttributes()
 * @method ProductType setAttributes(AttributeDefinitionCollection $attributes = null)
 */
class ProductType extends Resource
{
    /**
     * @return array
     */
    public function getFields()
    {
        return [
            'id' => [static::TYPE => 'string'],
            'version' => [static::TYPE => 'int'],
            'createdAt' => [static::TYPE => '\DateTime'],
            'lastModifiedAt' => [static::TYPE => '\DateTime'],
            'name' => [static::TYPE => 'string'],
            'description' => [static::TYPE => 'string'],
            'attributes' => [static::TYPE => '\Sphere\Core\Model\ProductType\AttributeDefinitionCollection']
        ];
    }
}
