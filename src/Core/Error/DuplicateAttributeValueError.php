<?php
/**
 * @author @jenschude <jens.schulze@commercetools.de>
 */

namespace Commercetools\Core\Error;

use Commercetools\Core\Model\Common\Attribute;

/**
 * @package Commercetools\Core\Error
 *
 * @method string getCode()
 * @method DuplicateAttributeValueError setCode(string $code = null)
 * @method string getMessage()
 * @method DuplicateAttributeValueError setMessage(string $message = null)
 * @method Attribute getAttribute()
 * @method DuplicateAttributeValueError setAttribute(Attribute $attribute = null)
 */
class DuplicateAttributeValueError extends ApiError
{
    const CODE = 'DuplicateAttributeValue';

    public function fieldDefinitions()
    {
        $definitions = parent::fieldDefinitions();
        $definitions['attribute'] = [static::TYPE => Attribute::class];

        return $definitions;
    }
}
