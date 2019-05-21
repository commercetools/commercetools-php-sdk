<?php
/**
 *
 */

namespace Commercetools\Core\Model\Common;

use Commercetools\Core\Model\Customer\CustomerReference;

/**
 * @package Commercetools\Core\Model\Common
 *
 * @method string getClientId()
 * @method CreatedBy setClientId(string $clientId = null)
 * @method string getExternalUserId()
 * @method CreatedBy setExternalUserId(string $externalUserId = null)
 * @method CustomerReference getCustomer()
 * @method CreatedBy setCustomer(CustomerReference $customer = null)
 * @method string getAnonymousId()
 * @method CreatedBy setAnonymousId(string $anonymousId = null)
 */
class CreatedBy extends ClientLogging
{
}
