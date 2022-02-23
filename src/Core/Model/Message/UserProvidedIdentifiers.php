<?php
/**
 *
 */

namespace Commercetools\Core\Model\Message;

use Commercetools\Core\Model\Common\ContainerAndKey;
use Commercetools\Core\Model\Common\JsonObject;
use Commercetools\Core\Model\Common\LocalizedString;

/**
 * @package Commercetools\Core\Model\Message
 *
 * @method string getKey()
 * @method UserProvidedIdentifiers setKey(string $key = null)
 * @method string getExternalId()
 * @method UserProvidedIdentifiers setExternalId(string $externalId = null)
 * @method string getOrderNumber()
 * @method UserProvidedIdentifiers setOrderNumber(string $orderNumber = null)
 * @method string getCustomerNumber()
 * @method UserProvidedIdentifiers setCustomerNumber(string $customerNumber = null)
 * @method string getSku()
 * @method UserProvidedIdentifiers setSku(string $sku = null)
 * @method LocalizedString getSlug()
 * @method UserProvidedIdentifiers setSlug(LocalizedString $slug = null)
 * @method ContainerAndKey getContainerAndKey()
 * @method UserProvidedIdentifiers setContainerAndKey(ContainerAndKey $containerAndKey = null)
 */
class UserProvidedIdentifiers extends JsonObject
{
    public function fieldDefinitions()
    {
        return [
            'key' => [self::TYPE => 'string', static::OPTIONAL => true],
            'externalId' => [self::TYPE => 'string', static::OPTIONAL => true],
            'orderNumber' => [self::TYPE => 'string', static::OPTIONAL => true],
            'customerNumber' => [self::TYPE => 'string', static::OPTIONAL => true],
            'sku' => [self::TYPE => 'string', static::OPTIONAL => true],
            'slug' => [self::TYPE => LocalizedString::class, static::OPTIONAL => true],
            'containerAndKey' => [self::TYPE => ContainerAndKey::class, static::OPTIONAL => true]
        ];
    }
}
