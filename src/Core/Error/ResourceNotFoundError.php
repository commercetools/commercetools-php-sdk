<?php
/**
 * @author @jenschude <jens.schulze@commercetools.de>
 */

namespace Commercetools\Core\Error;

/**
 * @package Commercetools\Core\Error
 *
 * @method string getCode()
 * @method ResourceNotFoundError setCode(string $code = null)
 * @method string getMessage()
 * @method ResourceNotFoundError setMessage(string $message = null)
 */
class ResourceNotFoundError extends ApiError
{
    const CODE = 'ResourceNotFound';
}
