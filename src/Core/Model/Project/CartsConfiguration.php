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
            'countryTaxRateFallbackEnabled' => [static::TYPE => 'bool', static::OPTIONAL => true],
        ];
    }
}
