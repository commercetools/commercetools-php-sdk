<?php
/**
 * @author @jayS-de <jens.schulze@commercetools.de>
 */

namespace Commercetools\Core\Error;

/**
 * @package Commercetools\Core\Error
 *
 * @method string getCode()
 * @method DuplicateFieldError setCode(string $code = null)
 * @method string getMessage()
 * @method DuplicateFieldError setMessage(string $message = null)
 * @method string getField()
 * @method DuplicateFieldError setField(string $field = null)
 * @method mixed getDuplicateValue()
 * @method DuplicateFieldError setDuplicateValue($duplicateValue = null)
 */
class DuplicateFieldError extends ApiError
{
    const CODE = 'DuplicateField';

    public function fieldDefinitions()
    {
        $definitions = parent::fieldDefinitions();
        $definitions['field'] = [static::TYPE => 'string'];
        $definitions['duplicateValue'] = [static::TYPE => null];

        return $definitions;
    }
}
