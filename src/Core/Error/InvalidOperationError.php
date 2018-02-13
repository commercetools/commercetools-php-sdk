<?php
/**
 * @author @jenschude <jens.schulze@commercetools.de>
 */

namespace Commercetools\Core\Error;

/**
 * @package Commercetools\Core\Error
 *
 * @method string getCode()
 * @method InvalidOperationError setCode(string $code = null)
 * @method string getMessage()
 * @method InvalidOperationError setMessage(string $message = null)
 */
class InvalidOperationError extends ApiError
{
    const CODE = 'InvalidOperation';
}
