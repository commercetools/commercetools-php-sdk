<?php
/**
 * @author @jenschude <jens.schulze@commercetools.de>
 */

namespace Commercetools\Core\Model\TaxCategory;

use Commercetools\Core\Model\Common\JsonObject;

/**
 * @package Commercetools\Core\Model\TaxCategory
 * @link https://docs.commercetools.com/http-api-projects-carts.html#externaltaxratedraft
 * @method string getName()
 * @method ExternalTaxRateDraft setName(string $name = null)
 * @method float getAmount()
 * @method ExternalTaxRateDraft setAmount(float $amount = null)
 * @method string getCountry()
 * @method ExternalTaxRateDraft setCountry(string $country = null)
 * @method string getState()
 * @method ExternalTaxRateDraft setState(string $state = null)
 * @method SubRateCollection getSubRates()
 * @method ExternalTaxRateDraft setSubRates(SubRateCollection $subRates = null)
 * @method bool getIncludedInPrice()
 * @method ExternalTaxRateDraft setIncludedInPrice(bool $includedInPrice = null)
 */
class ExternalTaxRateDraft extends JsonObject
{
    public function fieldDefinitions()
    {
        return [
            'name' => [self::TYPE => 'string'],
            'amount' => [self::TYPE => 'float', static::OPTIONAL => true],
            'includedInPrice' => [self::TYPE => 'bool', static::OPTIONAL => true],
            'country' => [self::TYPE => 'string'],
            'state' => [self::TYPE => 'string', static::OPTIONAL => true],
            'subRates' => [static::TYPE => SubRateCollection::class, static::OPTIONAL => true]
        ];
    }

    /**
     * @param string $name
     * @param string $country
     * @param float $amount
     * @return ExternalTaxRateDraft
     */
    public static function ofNameCountryAndAmount($name, $country, $amount)
    {
        return static::of()->setName($name)->setCountry($country)->setAmount($amount);
    }

    /**
     * @param string $name
     * @param string $country
     * @param float $amount
     * @param SubRateCollection $subRates
     * @return ExternalTaxRateDraft
     */
    public static function ofNameCountryAmountAndSubRates($name, $country, $amount, SubRateCollection $subRates)
    {
        return static::of()->setName($name)->setCountry($country)->setAmount($amount)->setSubRates($subRates);
    }

    /**
     * @param string $name
     * @param string $country
     * @param SubRateCollection $subRates
     * @return ExternalTaxRateDraft
     */
    public static function ofNameCountryAndSubRates($name, $country, SubRateCollection $subRates)
    {
        return static::of()->setName($name)->setCountry($country)->setSubRates($subRates);
    }
}
