<?php
/**
 * @author @jenschude <jens.schulze@commercetools.de>
 */

namespace Commercetools\Core\Error;

/**
 * @package Commercetools\Core\Error
 *
 * @method string getCode()
 * @method RequiredFieldError setCode(string $code = null)
 * @method string getMessage()
 * @method RequiredFieldError setMessage(string $message = null)
 * @method string getField()
 * @method RequiredFieldError setField(string $field = null)
 */
class RequiredFieldError extends ApiError
{
    const CODE = 'RequiredField';

    public function fieldDefinitions()
    {
        $definitions = parent::fieldDefinitions();
        $definitions['field'] = [static::TYPE => 'string'];

        return $definitions;
    }
}
