<?php
/**
 * @author @jenschude <jens.schulze@commercetools.de>
 */

namespace Commercetools\Core\Model\Cart;

use Commercetools\Core\Model\Common\JsonObject;
use Commercetools\Core\Model\Common\Money;
use Commercetools\Core\Model\TaxCategory\ExternalTaxRateDraft;

/**
 * @package Commercetools\Core\Model\Cart
 * @link http://docs.commercetools.com/http-api-projects-carts.html#externaltaxamountdraft
 * @method Money getTotalGross()
 * @method ExternalTaxAmountDraft setTotalGross(Money $totalGross = null)
 * @method ExternalTaxRateDraft getTaxRate()
 * @method ExternalTaxAmountDraft setTaxRate(ExternalTaxRateDraft $taxRate = null)
 */
class ExternalTaxAmountDraft extends JsonObject
{
    public function fieldDefinitions()
    {
        return [
            'totalGross' => [static::TYPE => Money::class],
            'taxRate' => [static::TYPE => ExternalTaxRateDraft::class]
        ];
    }
}
