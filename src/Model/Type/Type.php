<?php
/**
 * @author @jayS-de <jens.schulze@commercetools.de>
 */

namespace Commercetools\Core\Model\Type;

use Commercetools\Core\Model\Common\JsonObject;
use Commercetools\Core\Model\Common\DateTimeDecorator;
use Commercetools\Core\Model\Common\LocalizedString;
use Commercetools\Core\Model\Common\Resource;

/**
 * @package Commercetools\Core\Model\Type
 * @method string getId()
 * @method Type setId(string $id = null)
 * @method int getVersion()
 * @method Type setVersion(int $version = null)
 * @method string getKey()
 * @method Type setKey(string $key = null)
 * @method DateTimeDecorator getCreatedAt()
 * @method Type setCreatedAt(\DateTime $createdAt = null)
 * @method \DateTime getLastModifiedAt()
 * @method Type setLastModifiedAt(\DateTime $lastModifiedAt = null)
 * @method LocalizedString getName()
 * @method Type setName(LocalizedString $name = null)
 * @method LocalizedString getDescription()
 * @method Type setDescription(LocalizedString $description = null)
 * @method array getResourceTypeIds()
 * @method Type setResourceTypeIds(array $resourceTypeIds = null)
 * @method FieldDefinitionCollection getFieldDefinitions()
 * @method Type setFieldDefinitions(FieldDefinitionCollection $fieldDefinitions = null)
 */
class Type extends Resource
{
    public function fieldDefinitions()
    {
        return [
            'id' => [static::TYPE => 'string'],
            'version' => [static::TYPE => 'int'],
            'key' => [static::TYPE => 'string'],
            'createdAt' => [
                static::TYPE => '\DateTime',
                static::DECORATOR => '\Commercetools\Core\Model\Common\DateTimeDecorator'
            ],
            'lastModifiedAt' => [static::TYPE => '\DateTime'],
            'name' => [static::TYPE => '\Commercetools\Core\Model\Common\LocalizedString'],
            'description' => [static::TYPE => '\Commercetools\Core\Model\Common\LocalizedString'],
            'resourceTypeIds' => [static::TYPE => 'array'],
            'fieldDefinitions' => [static::TYPE => '\Commercetools\Core\Model\Type\FieldDefinitionCollection'],
        ];
    }
}
