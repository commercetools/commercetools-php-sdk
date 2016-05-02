<?php
/**
 * @author @jayS-de <jens.schulze@commercetools.de>
 */

namespace Commercetools\Core\Error;

/**
 * @package Commercetools\Core\Error
 *
 * @method string getCode()
 * @method InsufficientScopeError setCode(string $code = null)
 * @method string getMessage()
 * @method InsufficientScopeError setMessage(string $message = null)
 */
class InsufficientScopeError extends ApiError
{
    const CODE = 'insufficient_scope';
}
