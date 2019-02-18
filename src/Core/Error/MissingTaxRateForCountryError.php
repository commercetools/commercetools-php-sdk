<?php
/**
 */

namespace Commercetools\Core\Error;

/**
 * @package Commercetools\Core\Error
 *
 * @method string getCode()
 * @method MissingTaxRateForCountryError setCode(string $code = null)
 * @method string getMessage()
 * @method MissingTaxRateForCountryError setMessage(string $message = null)
 * @method string getTaxCategoryId()
 * @method MissingTaxRateForCountryError setTaxCategoryId(string $taxCategoryId = null)
 * @method string getCountry()
 * @method MissingTaxRateForCountryError setCountry(string $country = null)
 * @method string getState()
 * @method MissingTaxRateForCountryError setState(string $state = null)
 */
class MissingTaxRateForCountryError extends ApiError
{
    const CODE = 'MissingTaxRateForCountry';

    public function fieldDefinitions()
    {
        $definitions = parent::fieldDefinitions();
        $definitions['taxCategoryId'] = [static::TYPE => 'string'];
        $definitions['country'] = [static::TYPE => 'string'];
        $definitions['state'] = [static::TYPE => 'string'];

        return $definitions;
    }
}
