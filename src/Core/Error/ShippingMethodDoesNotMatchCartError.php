<?php
/**
 * @author @jenschude <jens.schulze@commercetools.de>
 */

namespace Commercetools\Core\Error;

/**
 * @package Commercetools\Core\Error
 *
 * @method string getCode()
 * @method ShippingMethodDoesNotMatchCartError setCode(string $code = null)
 * @method string getMessage()
 * @method ShippingMethodDoesNotMatchCartError setMessage(string $message = null)
 */
class ShippingMethodDoesNotMatchCartError extends ApiError
{
    const CODE = 'ShippingMethodDoesNotMatchCart';
}
