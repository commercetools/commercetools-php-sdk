<?php
/**
 * @author @jenschude <jens.schulze@commercetools.de>
 */

namespace Commercetools\Core\Model\CustomObject;

use Commercetools\Core\Model\Common\Resource;
use Commercetools\Core\Model\Common\DateTimeDecorator;
use DateTime;

/**
 * @package Commercetools\Core\Model\CustomObject
 * @link https://docs.commercetools.com/http-api-projects-custom-objects.html#customobject
 * @method string getId()
 * @method CustomObject setId(string $id = null)
 * @method int getVersion()
 * @method CustomObject setVersion(int $version = null)
 * @method DateTimeDecorator getCreatedAt()
 * @method CustomObject setCreatedAt(DateTime $createdAt = null)
 * @method DateTimeDecorator getLastModifiedAt()
 * @method CustomObject setLastModifiedAt(DateTime $lastModifiedAt = null)
 * @method string getContainer()
 * @method CustomObject setContainer(string $container = null)
 * @method string getKey()
 * @method CustomObject setKey(string $key = null)
 * @method mixed getValue()
 * @method CustomObject setValue($value = null)
 * @method CustomObjectReference getReference()
 */
class CustomObject extends Resource
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
            'container' => [static::TYPE => 'string'],
            'key' => [static::TYPE => 'string'],
            'value' => [],
        ];
    }
}
