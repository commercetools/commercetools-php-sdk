<?php
/**
 * @author @jayS-de <jens.schulze@commercetools.de>
 */

namespace Commercetools\Core\Error;

/**
 * @package Commercetools\Core\Error
 *
 * @method string getCode()
 * @method InvalidFieldError setCode(string $code = null)
 * @method string getMessage()
 * @method InvalidFieldError setMessage(string $message = null)
 * @method string getField()
 * @method InvalidFieldError setField(string $field = null)
 * @method mixed getInvalidValue()
 * @method InvalidFieldError setInvalidValue($invalidValue = null)
 * @method array getAllowedValues()
 * @method InvalidFieldError setAllowedValues(array $allowedValues = null)
 */
class InvalidFieldError extends ApiError
{
    const CODE = 'InvalidField';

    public function fieldDefinitions()
    {
        $definitions = parent::fieldDefinitions();
        $definitions['field'] = [static::TYPE => 'string'];
        $definitions['invalidValue'] = [static::TYPE => null];
        $definitions['allowedValues'] = [static::TYPE => 'array'];

        return $definitions;
    }
}
