<?php

namespace Commercetools\Core\Model\Project;

use Commercetools\Core\Model\Common\Context;
use Commercetools\Core\Model\Common\JsonObject;

/**
 * @package Commercetools\Core\Model\Project
 *
 * @method bool getCountryTaxRateFallbackEnabled()
 * @method CartsConfiguration setCountryTaxRateFallbackEnabled(bool $countryTaxRateFallbackEnabled = null)
 */
class CartsConfiguration extends JsonObject
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
     * @return CartsConfiguration
     */
    public static function ofCountryTaxRateFallbackEnabled($countryTaxRateFallbackEnabled, $context = null)
    {
        return static::of($context)->setCountryTaxRateFallbackEnabled($countryTaxRateFallbackEnabled);
    }
}
