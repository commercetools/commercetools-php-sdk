<?php
/**
 * @author @jenschude <jens.schulze@commercetools.de>
 */

namespace Commercetools\Core\Error;

/**
 * @package Commercetools\Core\Error
 *
 * @method string getCode()
 * @method InvalidCredentialsError setCode(string $code = null)
 * @method string getMessage()
 * @method InvalidCredentialsError setMessage(string $message = null)
 */
class InvalidCredentialsError extends ApiError
{
    const CODE = 'InvalidCredentials';
}
