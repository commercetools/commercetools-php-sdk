<?php
/**
 *
 */

namespace Commercetools\Core\Model\OrderEdit;

use Commercetools\Core\Model\Common\JsonObject;
use Commercetools\Core\Model\Common\Money;
use Commercetools\Core\Model\Common\TaxedPrice;

/**
 * @package Commercetools\Core\Model\OrderEdit
 *
 * @method Money getTotalPrice()
 * @method OrderExcerpt setTotalPrice(Money $totalPrice = null)
 * @method TaxedPrice getTaxedPrice()
 * @method OrderExcerpt setTaxedPrice(TaxedPrice $taxedPrice = null)
 * @method int getVersion()
 * @method OrderExcerpt setVersion(int $version = null)
 */
class OrderExcerpt extends JsonObject
{
    public function fieldDefinitions()
    {
        return [
            'totalPrice' => [static::TYPE => Money::class],
            'taxedPrice' => [static::TYPE => TaxedPrice::class],
            'version' => [static::TYPE => 'int']
        ];
    }
}
