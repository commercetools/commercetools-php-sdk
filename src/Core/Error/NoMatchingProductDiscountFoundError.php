<?php
/**
 */

namespace Commercetools\Core\Error;

/**
 * @package Commercetools\Core\Error
 *
 * @method string getCode()
 * @method NoMatchingProductDiscountFoundError setCode(string $code = null)
 * @method string getMessage()
 * @method NoMatchingProductDiscountFoundError setMessage(string $message = null)
 */
class NoMatchingProductDiscountFoundError extends ApiError
{
    const CODE = 'NoMatchingProductDiscountFound';
}
