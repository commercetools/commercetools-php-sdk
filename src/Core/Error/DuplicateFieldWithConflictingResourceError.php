<?php
/**
 */

namespace Commercetools\Core\Error;

use Commercetools\Core\Model\Common\Reference;

/**
 * @package Commercetools\Core\Error
 *
 * @method string getCode()
 * @method DuplicateFieldWithConflictingResourceError setCode(string $code = null)
 * @method string getMessage()
 * @method DuplicateFieldWithConflictingResourceError setMessage(string $message = null)
 * @method string getField()
 * @method DuplicateFieldWithConflictingResourceError setField(string $field = null)
 * @method mixed getDuplicateValue()
 * @method DuplicateFieldWithConflictingResourceError setDuplicateValue($duplicateValue = null)
 * @method Reference getConflictingResource()
 * @method DuplicateFieldWithConflictingResourceError setConflictingResource(Reference $conflictingResource = null)
 */
class DuplicateFieldWithConflictingResourceError extends ApiError
{
    const CODE = 'DuplicateFieldWithConflictingResource';

    public function fieldDefinitions()
    {
        $definitions = parent::fieldDefinitions();
        $definitions['field'] = [static::TYPE => 'string'];
        $definitions['duplicateValue'] = [static::TYPE => null];
        $definitions['conflictingResource'] = [static::TYPE => Reference::class];

        return $definitions;
    }
}
