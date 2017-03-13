<?php
/**
 * @author @jayS-de <jens.schulze@commercetools.de>
 */

namespace Commercetools\Core\Model\Common;

/**
 * @package Commercetools\Core\Model\Common
 * @link https://dev.commercetools.com/http-api-projects-carts.html#taxedprice
 * @method Money getTotalNet()
 * @method TaxedPrice setTotalNet(Money $totalNet = null)
 * @method Money getTotalGross()
 * @method TaxedPrice setTotalGross(Money $totalGross = null)
 * @method TaxPortionCollection getTaxPortions()
 * @method TaxedPrice setTaxPortions(TaxPortionCollection $taxPortions = null)
 */
class TaxedPrice extends JsonObject
{
    public function fieldDefinitions()
    {
        return [
            'totalNet' => [static::TYPE => Money::class],
            'totalGross' => [static::TYPE => Money::class],
            'taxPortions' => [static::TYPE => TaxPortionCollection::class],
        ];
    }
}
