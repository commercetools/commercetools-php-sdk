<?php
/**
 */

namespace Commercetools\Core\Model\Extension;

use Commercetools\Core\Model\Common\CreatedBy;
use Commercetools\Core\Model\Common\DateTimeDecorator;
use Commercetools\Core\Model\Common\LastModifiedBy;
use Commercetools\Core\Model\Common\Resource;
use DateTime;

/**
 * @package Commercetools\Core\Model\Extension
 *
 * @method string getId()
 * @method Extension setId(string $id = null)
 * @method int getVersion()
 * @method Extension setVersion(int $version = null)
 * @method DateTimeDecorator getCreatedAt()
 * @method Extension setCreatedAt(DateTime $createdAt = null)
 * @method DateTimeDecorator getLastModifiedAt()
 * @method Extension setLastModifiedAt(DateTime $lastModifiedAt = null)
 * @method string getKey()
 * @method Extension setKey(string $key = null)
 * @method Destination getDestination()
 * @method Extension setDestination(Destination $destination = null)
 * @method TriggerCollection getTriggers()
 * @method Extension setTriggers(TriggerCollection $triggers = null)
 * @method int getTimeoutInMs()
 * @method Extension setTimeoutInMs(int $timeoutInMs = null)
 * @method CreatedBy getCreatedBy()
 * @method Extension setCreatedBy(CreatedBy $createdBy = null)
 * @method LastModifiedBy getLastModifiedBy()
 * @method Extension setLastModifiedBy(LastModifiedBy $lastModifiedBy = null)
 */
class Extension extends Resource
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
            'key' => [static::TYPE => 'string', static::OPTIONAL => true],
            'destination' => [static::TYPE => Destination::class],
            'triggers' => [static::TYPE => TriggerCollection::class],
            'createdBy' => [static::TYPE => CreatedBy::class, static::OPTIONAL => true],
            'lastModifiedBy' => [static::TYPE => LastModifiedBy::class, static::OPTIONAL => true],
            'timeoutInMs' => [static::TYPE => 'int', static::OPTIONAL => true],
        ];
    }
}
