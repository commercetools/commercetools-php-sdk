<?php
/**
 * @author @jayS-de <jens.schulze@commercetools.de>
 */

namespace Commercetools\Core\Error;

use Commercetools\Core\Model\Common\Attribute;

/**
 * @package Commercetools\Core\Error
 *
 * @method string getCode()
 * @method DiscountCodeNonApplicableError setCode(string $code = null)
 * @method string getMessage()
 * @method DiscountCodeNonApplicableError setMessage(string $message = null)
 */
class DiscountCodeNonApplicableError extends ApiError
{
    const CODE = 'DiscountCodeNonApplicable';
}
