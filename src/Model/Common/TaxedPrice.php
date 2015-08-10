<?php
/**
 * @author @ct-jensschulze <jens.schulze@commercetools.de>
 */

namespace Commercetools\Core\Model\Common;


/**
 * @package Commercetools\Core\Model\Common
 * @apidoc http://dev.sphere.io/http-api-projects-carts.html#taxed-price
 * @method Money getTotalNet()
 * @method TaxedPrice setTotalNet(Money $totalNet = null)
 * @method Money getTotalGross()
 * @method TaxedPrice setTotalGross(Money $totalGross = null)
 * @method TaxPortionCollection getTaxPortions()
 * @method TaxedPrice setTaxPortions(TaxPortionCollection $taxPortions = null)
 */
class TaxedPrice extends JsonObject
{
    public function getPropertyDefinitions()
    {
        return [
            'totalNet' => [static::TYPE => '\Commercetools\Core\Model\Common\Money'],
            'totalGross' => [static::TYPE => '\Commercetools\Core\Model\Common\Money'],
            'taxPortions' => [static::TYPE => '\Commercetools\Core\Model\Common\TaxPortionCollection'],
        ];
    }
}
