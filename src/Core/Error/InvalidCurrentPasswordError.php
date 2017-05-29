<?php
/**
 * @author @jayS-de <jens.schulze@commercetools.de>
 */

namespace Commercetools\Core\Error;

/**
 * @package Commercetools\Core\Error
 *
 * @method string getCode()
 * @method InvalidCurrentPasswordError setCode(string $code = null)
 * @method string getMessage()
 * @method InvalidCurrentPasswordError setMessage(string $message = null)
 */
class InvalidCurrentPasswordError extends ApiError
{
    const CODE = 'InvalidCurrentPassword';
}
