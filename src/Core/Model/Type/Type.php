<?php
/**
 * @author @jenschude <jens.schulze@commercetools.de>
 */

namespace Commercetools\Core\Model\Type;

use Commercetools\Core\Model\Common\CreatedBy;
use Commercetools\Core\Model\Common\JsonObject;
use Commercetools\Core\Model\Common\DateTimeDecorator;
use Commercetools\Core\Model\Common\LastModifiedBy;
use Commercetools\Core\Model\Common\LocalizedString;
use Commercetools\Core\Model\Common\Resource;
use DateTime;

/**
 * @package Commercetools\Core\Model\Type
 * @link https://docs.commercetools.com/http-api-projects-types.html#type
 * @method string getId()
 * @method Type setId(string $id = null)
 * @method int getVersion()
 * @method Type setVersion(int $version = null)
 * @method string getKey()
 * @method Type setKey(string $key = null)
 * @method DateTimeDecorator getCreatedAt()
 * @method Type setCreatedAt(DateTime $createdAt = null)
 * @method DateTimeDecorator getLastModifiedAt()
 * @method Type setLastModifiedAt(DateTime $lastModifiedAt = null)
 * @method LocalizedString getName()
 * @method Type setName(LocalizedString $name = null)
 * @method LocalizedString getDescription()
 * @method Type setDescription(LocalizedString $description = null)
 * @method array getResourceTypeIds()
 * @method Type setResourceTypeIds(array $resourceTypeIds = null)
 * @method FieldDefinitionCollection getFieldDefinitions()
 * @method Type setFieldDefinitions(FieldDefinitionCollection $fieldDefinitions = null)
 * @method CreatedBy getCreatedBy()
 * @method Type setCreatedBy(CreatedBy $createdBy = null)
 * @method LastModifiedBy getLastModifiedBy()
 * @method Type setLastModifiedBy(LastModifiedBy $lastModifiedBy = null)
 * @method TypeReference getReference()
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
                static::TYPE => DateTime::class,
                static::DECORATOR => DateTimeDecorator::class
            ],
            'lastModifiedAt' => [
                static::TYPE => DateTime::class,
                static::DECORATOR => DateTimeDecorator::class
            ],
            'name' => [static::TYPE => LocalizedString::class],
            'description' => [static::TYPE => LocalizedString::class],
            'resourceTypeIds' => [static::TYPE => 'array'],
            'fieldDefinitions' => [static::TYPE => FieldDefinitionCollection::class],
            'createdBy' => [static::TYPE => CreatedBy::class],
            'lastModifiedBy' => [static::TYPE => LastModifiedBy::class],
        ];
    }
}
