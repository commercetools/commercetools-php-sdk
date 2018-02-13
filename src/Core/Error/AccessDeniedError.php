<?php
/**
 * @author @jenschude <jens.schulze@commercetools.de>
 */

namespace Commercetools\Core\Error;

/**
 * @package Commercetools\Core\Error
 *
 * @method string getCode()
 * @method AccessDeniedError setCode(string $code = null)
 * @method string getMessage()
 * @method AccessDeniedError setMessage(string $message = null)
 */
class AccessDeniedError extends ApiError
{
    const CODE = 'access_denied';
}
