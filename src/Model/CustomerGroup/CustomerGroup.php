<?php
/**
 * @author @jayS-de <jens.schulze@commercetools.de>
 */

namespace Commercetools\Core\Model\CustomerGroup;

use Commercetools\Core\Model\Common\Resource;
use Commercetools\Core\Model\Common\DateTimeDecorator;

/**
 * @package Commercetools\Core\Model\CustomerGroup
 * @link https://dev.commercetools.com/http-api-projects-customerGroups.html#customergroup
 * @method string getId()
 * @method CustomerGroup setId(string $id = null)
 * @method int getVersion()
 * @method CustomerGroup setVersion(int $version = null)
 * @method DateTimeDecorator getCreatedAt()
 * @method CustomerGroup setCreatedAt(\DateTime $createdAt = null)
 * @method DateTimeDecorator getLastModifiedAt()
 * @method CustomerGroup setLastModifiedAt(\DateTime $lastModifiedAt = null)
 * @method string getName()
 * @method CustomerGroup setName(string $name = null)
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
                static::TYPE => '\DateTime',
                static::DECORATOR => '\Commercetools\Core\Model\Common\DateTimeDecorator'
            ],
            'lastModifiedAt' => [
                static::TYPE => '\DateTime',
                static::DECORATOR => '\Commercetools\Core\Model\Common\DateTimeDecorator'
            ],
            'name' => [static::TYPE => 'string']
        ];
    }
}
