<?php
/**
 */

namespace Commercetools\Core\Model\Common;

use Commercetools\Core\Model\Customer\CustomerReference;

/**
 * @package Commercetools\Core\Model\Common
 *
 * @method string getClientId()
 * @method ClientLogging setClientId(string $clientId = null)
 * @method string getExternalUserId()
 * @method ClientLogging setExternalUserId(string $externalUserId = null)
 * @method CustomerReference getCustomer()
 * @method ClientLogging setCustomer(CustomerReference $customer = null)
 * @method string getAnonymousId()
 * @method ClientLogging setAnonymousId(string $anonymousId = null)
 */
class ClientLogging extends JsonObject
{
    public function fieldDefinitions()
    {
        return [
            'clientId' => [static::TYPE => 'string', static::OPTIONAL => true],
            'externalUserId' => [static::TYPE => 'string', static::OPTIONAL => true],
            'customer' => [static::TYPE => CustomerReference::class, static::OPTIONAL => true],
            'anonymousId' => [static::TYPE => 'string', static::OPTIONAL => true],
        ];
    }
}
