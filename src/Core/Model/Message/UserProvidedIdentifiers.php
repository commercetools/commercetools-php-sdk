<?php
/**
 *
 */

namespace Commercetools\Core\Model\Message;

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
 */
class UserProvidedIdentifiers extends JsonObject
{
    public function fieldDefinitions()
    {
        return [
            'key' => [self::TYPE => 'string'],
            'externalId' => [self::TYPE => 'string'],
            'orderNumber' => [self::TYPE => 'string'],
            'customerNumber' => [self::TYPE => 'string'],
            'sku' => [self::TYPE => 'string'],
            'slug' => [self::TYPE => LocalizedString::class],
        ];
    }
}
