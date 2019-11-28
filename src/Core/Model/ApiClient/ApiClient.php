<?php
/**
 */

namespace Commercetools\Core\Model\ApiClient;

use Commercetools\Core\Model\Common\DateDecorator;
use Commercetools\Core\Model\Common\DateTimeDecorator;
use Commercetools\Core\Model\Common\JsonObject;
use DateTime;

/**
 * @package Commercetools\Core\Model\ApiClient
 *
 * @method string getId()
 * @method ApiClient setId(string $id = null)
 * @method string getName()
 * @method ApiClient setName(string $name = null)
 * @method string getScope()
 * @method ApiClient setScope(string $scope = null)
 * @method DateTimeDecorator getCreatedAt()
 * @method ApiClient setCreatedAt(DateTime $createdAt = null)
 * @method DateDecorator getLastUsedAt()
 * @method ApiClient setLastUsedAt(DateTime $lastUsedAt = null)
 * @method string getSecret()
 * @method ApiClient setSecret(string $secret = null)
 * @method DateTimeDecorator getDeleteAt()
 * @method ApiClient setDeleteAt(DateTime $deleteAt = null)
 */
class ApiClient extends JsonObject
{
    public function fieldDefinitions()
    {
        return [
            'id' => [static::TYPE => 'string'],
            'name' => [static::TYPE => 'string'],
            'scope' => [static::TYPE => 'string'],
            'createdAt' => [
                static::TYPE => DateTime::class,
                static::DECORATOR => DateTimeDecorator::class
            ],
            'lastUsedAt' => [
                static::TYPE => DateTime::class,
                static::DECORATOR => DateDecorator::class
            ],
            'secret' => [static::TYPE => 'string'],
            'deleteAt' => [
                static::TYPE => DateTime::class,
                static::DECORATOR => DateTimeDecorator::class
            ],
        ];
    }
}
