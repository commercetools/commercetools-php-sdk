<?php
/**
 * @author @jenschude <jens.schulze@commercetools.de>
 */

namespace Commercetools\Core\Error;

/**
 * @package Commercetools\Core\Error
 *
 * @method string getCode()
 * @method InvalidTokenError setCode(string $code = null)
 * @method string getMessage()
 * @method InvalidTokenError setMessage(string $message = null)
 */
class InvalidTokenError extends ApiError
{
    const CODE = 'invalid_token';
}
