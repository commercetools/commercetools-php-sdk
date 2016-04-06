<?php
/**
 * @author @jayS-de <jens.schulze@commercetools.de>
 */

namespace Commercetools\Core\Error;

/**
 * @package Commercetools\Core\Error
 *
 * @method string getCode()
 * @method InvalidSubjectError setCode(string $code = null)
 * @method string getMessage()
 * @method InvalidSubjectError setMessage(string $message = null)
 */
class InvalidSubjectError extends ApiError
{
    const CODE = 'InvalidSubject';
}
