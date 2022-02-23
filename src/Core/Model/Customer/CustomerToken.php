<?php
/**
 * @author @jenschude <jens.schulze@commercetools.de>
 */

namespace Commercetools\Core\Model\Customer;

use Commercetools\Core\Model\Common\JsonObject;
use Commercetools\Core\Model\Common\DateTimeDecorator;
use DateTime;

/**
 * @package Commercetools\Core\Model\Customer
 * @link https://docs.commercetools.com/http-api-projects-customers.html#customertoken
 * @method string getId()
 * @method CustomerToken setId(string $id = null)
 * @method string getCustomerId()
 * @method CustomerToken setCustomerId(string $customerId = null)
 * @method DateTimeDecorator getCreatedAt()
 * @method CustomerToken setCreatedAt(DateTime $createdAt = null)
 * @method DateTimeDecorator getLastModifiedAt()
 * @method CustomerToken setLastModifiedAt(DateTime $lastModifiedAt = null)
 * @method DateTimeDecorator getExpiresAt()
 * @method CustomerToken setExpiresAt(DateTime $expiresAt = null)
 * @method string getValue()
 * @method CustomerToken setValue(string $value = null)
 */
class CustomerToken extends JsonObject
{
    public function fieldDefinitions()
    {
        return [
            'id' => [static::TYPE => 'string'],
            'customerId' => [static::TYPE => 'string'],
            'createdAt' => [
                static::TYPE => DateTime::class,
                static::DECORATOR => DateTimeDecorator::class
            ],
            'lastModifiedAt' => [
                static::TYPE => DateTime::class,
                static::OPTIONAL => true,
                static::DECORATOR => DateTimeDecorator::class
            ],
            'expiresAt' => [
                static::TYPE => DateTime::class,
                static::DECORATOR => DateTimeDecorator::class
            ],
            'value' => [static::TYPE => 'string'],
        ];
    }
}
