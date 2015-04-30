<?php
/**
 * @author @ct-jensschulze <jens.schulze@commercetools.de>
 */

namespace Sphere\Core\Model\Customer;

use Sphere\Core\Model\Common\JsonObject;

/**
 * Class CustomerToken
 * @package Sphere\Core\Model\Customer
 * @link http://dev.sphere.io/http-api-projects-customers.html#customer-token
 * @method string getId()
 * @method CustomerToken setId(string $id = null)
 * @method string getCustomerId()
 * @method CustomerToken setCustomerId(string $customerId = null)
 * @method \DateTime getCreatedAt()
 * @method CustomerToken setCreatedAt(\DateTime $createdAt = null)
 * @method \DateTime getLastModifiedAt()
 * @method CustomerToken setLastModifiedAt(\DateTime $lastModifiedAt = null)
 * @method \DateTime getExpiresAt()
 * @method CustomerToken setExpiresAt(\DateTime $expiresAt = null)
 * @method string getValue()
 * @method CustomerToken setValue(string $value = null)
 */
class CustomerToken extends JsonObject
{
    public function getFields()
    {
        return [
            'id' => [static::TYPE => 'string'],
            'customerId' => [static::TYPE => 'string'],
            'createdAt' => [static::TYPE => '\DateTime'],
            'lastModifiedAt' => [static::TYPE => '\DateTime'],
            'expiresAt' => [static::TYPE => '\DateTime'],
            'value' => [static::TYPE => 'string'],
        ];
    }
}
