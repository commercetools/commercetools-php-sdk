<?php
/**
 * @author @jenschude <jens.schulze@commercetools.de>
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
 * @method AttributeCollection getAttributes()
 * @method DuplicateAttributeValuesError setAttributes(AttributeCollection $attributes = null)
 */
class DuplicateAttributeValuesError extends ApiError
{
    const CODE = 'DuplicateAttributeValues';

    public function fieldDefinitions()
    {
        $definitions = parent::fieldDefinitions();
        $definitions['attributes'] = [static::TYPE => AttributeCollection::class];

        return $definitions;
    }
}
