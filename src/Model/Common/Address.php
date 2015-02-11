<?php
/**
 * @author @ct-jensschulze <jens.schulze@commercetools.de>
 * @created: 11.02.15, 15:37
 */

namespace Sphere\Core\Model\Common;


class Address extends JsonObject
{
    public function getFields()
    {
        return [
            'id' => [self::TYPE => 'string', static::OPTIONAL],
            'title' => [self::TYPE => 'string', static::OPTIONAL],
            'salutation' => [self::TYPE => 'string', static::OPTIONAL],
            'firstName' => [self::TYPE => 'string', static::OPTIONAL],
            'lastName' => [self::TYPE => 'string', static::OPTIONAL],
            'streetName' => [self::TYPE => 'string', static::OPTIONAL],
            'streetNumber' => [self::TYPE => 'string', static::OPTIONAL],
            'additionalStreetInfo' => [self::TYPE => 'string', static::OPTIONAL],
            'postalCode' => [self::TYPE => 'string', static::OPTIONAL],
            'city' => [self::TYPE => 'string', static::OPTIONAL],
            'region' => [self::TYPE => 'string', static::OPTIONAL],
            'state' => [self::TYPE => 'string', static::OPTIONAL],
            'country' => [self::TYPE => 'string', static::OPTIONAL],
            'company' => [self::TYPE => 'string', static::OPTIONAL],
            'department' => [self::TYPE => 'string', static::OPTIONAL],
            'building' => [self::TYPE => 'string', static::OPTIONAL],
            'apartment' => [self::TYPE => 'string', static::OPTIONAL],
            'pOBox' => [self::TYPE => 'string', static::OPTIONAL],
            'phone' => [self::TYPE => 'string', static::OPTIONAL],
            'mobile' => [self::TYPE => 'string', static::OPTIONAL],
            'email' => [self::TYPE => 'string', static::OPTIONAL],
            'additionalAddressInfo' => [self::TYPE => 'string', static::OPTIONAL],
        ];
    }
}
