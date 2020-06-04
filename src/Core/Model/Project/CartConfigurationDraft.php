<?php
/**
 */

namespace Commercetools\Core\Model\Project;

use Commercetools\Core\Model\Common\Context;
use Commercetools\Core\Model\Common\JsonObject;

/**
 * @package Commercetools\Core\Model\Project
 *
 * @method bool getCountryTaxRateFallbackEnabled()
 * @method CartConfigurationDraft setCountryTaxRateFallbackEnabled(bool $countryTaxRateFallbackEnabled = null)
 */
class CartConfigurationDraft extends JsonObject
{
    public function fieldDefinitions()
    {
        return [
            'countryTaxRateFallbackEnabled' => [static::TYPE => 'bool'],
        ];
    }

    /**
     * @param bool $countryTaxRateFallbackEnabled
     * @param Context|callable $context
     * @return CartConfigurationDraft
     */
    public static function ofCountryTaxRateFallbackEnabled($countryTaxRateFallbackEnabled, $context = null)
    {
        return static::of($context)->setCountryTaxRateFallbackEnabled($countryTaxRateFallbackEnabled);
    }
}
