<?php
/**
 * @author @jayS-de <jens.schulze@commercetools.de>
 */

namespace Commercetools\Core\Error;

use Commercetools\Core\Model\Common\PriceCollection;

/**
 * @package Commercetools\Core\Error
 *
 * @method string getCode()
 * @method DuplicatePriceScopeError setCode(string $code = null)
 * @method string getMessage()
 * @method DuplicatePriceScopeError setMessage(string $message = null)
 * @method PriceCollection getConflictingPrices()
 * @method DuplicatePriceScopeError setConflictingPrices(PriceCollection $conflictingPrices = null)
 */
class DuplicatePriceScopeError extends ApiError
{
    const CODE = 'DuplicatePriceScope';

    public function fieldDefinitions()
    {
        $definitions = parent::fieldDefinitions();
        $definitions['conflictingPrices'] = [static::TYPE => PriceCollection::class];

        return $definitions;
    }
}
