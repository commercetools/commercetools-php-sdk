<?php
/**
 * @author @ct-jensschulze <jens.schulze@commercetools.de>
 */

namespace Sphere\Core\Model\Common;


/**
 * @package Sphere\Core\Model\Common
 * @link http://dev.sphere.io/http-api-projects-carts.html#taxed-price
 * @method Money getTotalNet()
 * @method TaxedPrice setTotalNet(Money $totalNet = null)
 * @method Money getTotalGross()
 * @method TaxedPrice setTotalGross(Money $totalGross = null)
 * @method TaxPortionCollection getTaxPortions()
 * @method TaxedPrice setTaxPortions(TaxPortionCollection $taxPortions = null)
 */
class TaxedPrice extends JsonObject
{
    public function getFields()
    {
        return [
            'totalNet' => [static::TYPE => '\Sphere\Core\Model\Common\Money'],
            'totalGross' => [static::TYPE => '\Sphere\Core\Model\Common\Money'],
            'taxPortions' => [static::TYPE => '\Sphere\Core\Model\Common\TaxPortionCollection'],
        ];
    }
}
