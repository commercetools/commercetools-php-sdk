<?php
/**
 * @author @ct-jensschulze <jens.schulze@commercetools.de>
 */

namespace Sphere\Core\Model\Customer;


use Sphere\Core\Model\Common\JsonObject;

/**
 * Class CustomerToken
 * @package Sphere\Core\Model\Customer
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
