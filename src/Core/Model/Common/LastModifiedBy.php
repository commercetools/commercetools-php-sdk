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
 * @method LastModifiedBy setClientId(string $clientId = null)
 * @method string getExternalUserId()
 * @method LastModifiedBy setExternalUserId(string $externalUserId = null)
 * @method CustomerReference getCustomer()
 * @method LastModifiedBy setCustomer(CustomerReference $customer = null)
 * @method string getAnonymousId()
 * @method LastModifiedBy setAnonymousId(string $anonymousId = null)
 */
class LastModifiedBy extends ClientLogging
{
}
