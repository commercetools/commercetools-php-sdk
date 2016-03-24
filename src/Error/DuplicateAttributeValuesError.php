<?php
/**
 * @author @jayS-de <jens.schulze@commercetools.de>
 */

namespace Commercetools\Core\Error;

use Commercetools\Core\Model\Common\AttributeCollection;

/**
 * @package Commercetools\Core\Error
 *
 * @method string getCode()
 * @method DuplicateAttributeValuesError setCode(string $code = null)
 * @method string getMessage()
 * @method DuplicateAttributeValuesError setMessage(string $message = null)
 * @method AttributeCollection getAttribute()
 * @method DuplicateAttributeValuesError setAttribute(AttributeCollection $attribute = null)
 */
class DuplicateAttributeValuesError extends ApiError
{
    const CODE = 'DuplicateAttributeValues';

    public function fieldDefinitions()
    {
        $definitions = parent::fieldDefinitions();
        $definitions['attribute'] = [static::TYPE => '\Commercetools\Core\Model\Common\AttributeCollection'];

        return $definitions;
    }
}
