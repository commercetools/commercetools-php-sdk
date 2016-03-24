<?php
/**
 * @author @jayS-de <jens.schulze@commercetools.de>
 */

namespace Commercetools\Core\Error;

/**
 * @package Commercetools\Core\Error
 *
 * @method string getCode()
 * @method DuplicateVariantValues setCode(string $code = null)
 * @method string getMessage()
 * @method DuplicateVariantValues setMessage(string $message = null)
 * @method array getVariantValues()
 * @method DuplicateVariantValues setVariantValues(array $variantValues = null)
 */
class DuplicateVariantValues extends ApiError
{
    const CODE = 'DuplicateVariant';

    public function fieldDefinitions()
    {
        $definitions = parent::fieldDefinitions();
        $definitions['variantValues'] = [static::TYPE => 'array'];

        return $definitions;
    }
}
