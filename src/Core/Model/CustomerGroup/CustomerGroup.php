<?php
/**
 * @author @jenschude <jens.schulze@commercetools.de>
 */

namespace Commercetools\Core\Model\CustomerGroup;

use Commercetools\Core\Model\Common\Resource;
use Commercetools\Core\Model\Common\DateTimeDecorator;
use Commercetools\Core\Model\CustomField\CustomFieldObject;
use DateTime;

/**
 * @package Commercetools\Core\Model\CustomerGroup
 * @link https://docs.commercetools.com/http-api-projects-customerGroups.html#customergroup
 * @method string getId()
 * @method CustomerGroup setId(string $id = null)
 * @method int getVersion()
 * @method CustomerGroup setVersion(int $version = null)
 * @method DateTimeDecorator getCreatedAt()
 * @method CustomerGroup setCreatedAt(DateTime $createdAt = null)
 * @method DateTimeDecorator getLastModifiedAt()
 * @method CustomerGroup setLastModifiedAt(DateTime $lastModifiedAt = null)
 * @method string getName()
 * @method CustomerGroup setName(string $name = null)
 * @method string getKey()
 * @method CustomerGroup setKey(string $key = null)
 * @method CustomFieldObject getCustom()
 * @method CustomerGroup setCustom(CustomFieldObject $custom = null)
 * @method CustomerGroupReference getReference()
 */
class CustomerGroup extends Resource
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
            'name' => [static::TYPE => 'string'],
            'key' => [static::TYPE => 'string'],
            'custom' => [static::TYPE => CustomFieldObject::class],
        ];
    }
}
