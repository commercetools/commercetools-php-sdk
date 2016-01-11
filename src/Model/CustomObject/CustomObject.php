<?php
/**
 * @author @jayS-de <jens.schulze@commercetools.de>
 */

namespace Commercetools\Core\Model\CustomObject;

use Commercetools\Core\Model\Common\Resource;
use Commercetools\Core\Model\Common\DateTimeDecorator;

/**
 * @package Commercetools\Core\Model\CustomObject
 * @apidoc http://dev.sphere.io/http-api-projects-custom-objects.html#custom-object
 * @method string getId()
 * @method CustomObject setId(string $id = null)
 * @method int getVersion()
 * @method CustomObject setVersion(int $version = null)
 * @method DateTimeDecorator getCreatedAt()
 * @method CustomObject setCreatedAt(\DateTime $createdAt = null)
 * @method DateTimeDecorator getLastModifiedAt()
 * @method CustomObject setLastModifiedAt(\DateTime $lastModifiedAt = null)
 * @method string getContainer()
 * @method CustomObject setContainer(string $container = null)
 * @method string getKey()
 * @method CustomObject setKey(string $key = null)
 * @method getValue()
 * @method CustomObject setValue($value = null)
 */
class CustomObject extends Resource
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
            'container' => [static::TYPE => 'string'],
            'key' => [static::TYPE => 'string'],
            'value' => [],
        ];
    }
}
