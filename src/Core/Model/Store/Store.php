<?php
/**
 */

namespace Commercetools\Core\Model\Store;

use Commercetools\Core\Model\Common\DateTimeDecorator;
use Commercetools\Core\Model\Common\LocalizedString;
use Commercetools\Core\Model\Common\Resource;
use DateTime;

/**
 * @package Commercetools\Core\Model\Store
 * @link https://docs.commercetools.com/http-api-projects-stores#store
 * @method string getId()
 * @method Store setId(string $id = null)
 * @method int getVersion()
 * @method Store setVersion(int $version = null)
 * @method string getKey()
 * @method Store setKey(string $key = null)
 * @method LocalizedString getName()
 * @method Store setName(LocalizedString $name = null)
 * @method DateTimeDecorator getCreatedAt()
 * @method Store setCreatedAt(DateTime $createdAt = null)
 * @method DateTimeDecorator getLastModifiedAt()
 * @method Store setLastModifiedAt(DateTime $lastModifiedAt = null)
 * @method StoreReference getReference()
 */
class Store extends Resource
{
    public function fieldDefinitions()
    {
        return [
            'id' => [static::TYPE => 'string'],
            'version' => [static::TYPE => 'int'],
            'key' => [static::TYPE => 'string'],
            'name' => [static::TYPE => LocalizedString::class],
            'createdAt' => [
                static::TYPE => DateTime::class,
                static::DECORATOR => DateTimeDecorator::class
            ],
            'lastModifiedAt' => [
                static::TYPE => DateTime::class,
                static::DECORATOR => DateTimeDecorator::class
            ],
        ];
    }
}
