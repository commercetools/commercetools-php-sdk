<?php
/**
 * @author @jayS-de <jens.schulze@commercetools.de>
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
            'totalNet' => [static::TYPE => '\Commercetools\Core\Model\Common\Money'],
            'totalGross' => [static::TYPE => '\Commercetools\Core\Model\Common\Money'],
        ];
    }
}
