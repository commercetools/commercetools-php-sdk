<?php
/**
 * @author @ct-jensschulze <jens.schulze@commercetools.de>
 */

namespace Commercetools\Core\Model\Customer;

use Commercetools\Core\Model\Common\JsonObject;
use Commercetools\Core\Model\Common\DateTimeDecorator;

/**
 * @package Commercetools\Core\Model\Customer
 * @apidoc http://dev.sphere.io/http-api-projects-customers.html#customer-token
 * @method string getId()
 * @method CustomerToken setId(string $id = null)
 * @method string getCustomerId()
 * @method CustomerToken setCustomerId(string $customerId = null)
 * @method DateTimeDecorator getCreatedAt()
 * @method CustomerToken setCreatedAt(\DateTime $createdAt = null)
 * @method DateTimeDecorator getLastModifiedAt()
 * @method CustomerToken setLastModifiedAt(\DateTime $lastModifiedAt = null)
 * @method DateTimeDecorator getExpiresAt()
 * @method CustomerToken setExpiresAt(\DateTime $expiresAt = null)
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
                static::TYPE => '\DateTime',
                static::DECORATOR => '\Commercetools\Core\Model\Common\DateTimeDecorator'
            ],
            'lastModifiedAt' => [
                static::TYPE => '\DateTime',
                static::DECORATOR => '\Commercetools\Core\Model\Common\DateTimeDecorator'
            ],
            'expiresAt' => [
                static::TYPE => '\DateTime',
                static::DECORATOR => '\Commercetools\Core\Model\Common\DateTimeDecorator'
            ],
            'value' => [static::TYPE => 'string'],
        ];
    }
}
