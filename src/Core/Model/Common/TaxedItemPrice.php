<?php
/**
 * @author @jenschude <jens.schulze@commercetools.de>
 */

namespace Commercetools\Core\Model\Common;

/**
 * @package Commercetools\Core\Model\Common
 *
 * @method Money getTotalNet()
 * @method TaxedItemPrice setTotalNet(Money $totalNet = null)
 * @method Money getTotalGross()
 * @method TaxedItemPrice setTotalGross(Money $totalGross = null)
 */
class TaxedItemPrice extends JsonObject
{
    public function fieldDefinitions()
    {
        return [
            'totalNet' => [static::TYPE => Money::class],
            'totalGross' => [static::TYPE => Money::class],
        ];
    }
}
