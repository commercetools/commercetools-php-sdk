<?php
/**
 * @author @jayS-de <jens.schulze@commercetools.de>
 */

namespace Commercetools\Core\Error;

/**
 * @package Commercetools\Core\Error
 *
 * @method string getCode()
 * @method DuplicateVariantValuesError setCode(string $code = null)
 * @method string getMessage()
 * @method DuplicateVariantValuesError setMessage(string $message = null)
 * @method array getVariantValues()
 * @method DuplicateVariantValuesError setVariantValues(array $variantValues = null)
 */
class DuplicateVariantValuesError extends ApiError
{
    const CODE = 'DuplicateVariantValues';

    public function fieldDefinitions()
    {
        $definitions = parent::fieldDefinitions();
        $definitions['variantValues'] = [static::TYPE => 'array'];

        return $definitions;
    }
}
