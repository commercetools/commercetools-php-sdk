<?php
/**
 */

namespace Commercetools\Core\Error;

/**
 * @package Commercetools\Core\Error
 *
 * @method string getCode()
 * @method EnumValueIsUsedError setCode(string $code = null)
 * @method string getMessage()
 * @method EnumValueIsUsedError setMessage(string $message = null)
 */
class EnumValueIsUsedError extends ApiError
{
    const CODE = 'EnumValueIsUsed';
}
