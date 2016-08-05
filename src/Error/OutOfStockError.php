<?php
/**
 * @author @jayS-de <jens.schulze@commercetools.de>
 */

namespace Commercetools\Core\Error;

/**
 * @package Commercetools\Core\Error
 *
 * @method string getCode()
 * @method OutOfStockError setCode(string $code = null)
 * @method string getMessage()
 * @method OutOfStockError setMessage(string $message = null)
 * @method array getLineItems()
 * @method OutOfStockError setLineItems(array $lineItems = null)
 * @method array getSkus()
 * @method OutOfStockError setSkus(array $skus = null)
 */
class OutOfStockError extends ApiError
{
    const CODE = 'OutOfStock';

    public function fieldDefinitions()
    {
        $definitions = parent::fieldDefinitions();
        $definitions['lineItems'] = [static::TYPE => 'array'];
        $definitions['skus'] = [static::TYPE => 'array'];

        return $definitions;
    }
}
