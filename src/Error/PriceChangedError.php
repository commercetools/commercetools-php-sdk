<?php
/**
 * @author @jayS-de <jens.schulze@commercetools.de>
 */

namespace Commercetools\Core\Error;

/**
 * @package Commercetools\Core\Error
 *
 * @method string getCode()
 * @method PriceChangedError setCode(string $code = null)
 * @method string getMessage()
 * @method PriceChangedError setMessage(string $message = null)
 * @method array getLineItems()
 * @method PriceChangedError setLineItems(array $lineItems = null)
 * @method bool getShipping()
 * @method PriceChangedError setShipping(bool $shipping = null)
 */
class PriceChangedError extends ApiError
{
    const CODE = 'PriceChanged';

    public function fieldDefinitions()
    {
        $definitions = parent::fieldDefinitions();
        $definitions['lineItems'] = [static::TYPE => 'array'];
        $definitions['shipping'] = [static::TYPE => 'bool'];

        return $definitions;
    }
}
