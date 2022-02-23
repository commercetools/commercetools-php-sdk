<?php
/**
 * @author @jenschude <jens.schulze@commercetools.de>
 */

namespace Commercetools\Core\Model\TaxCategory;

use Commercetools\Core\Model\Common\JsonObject;

/**
 * @package Commercetools\Core\Model\TaxCategory
 * @link https://docs.commercetools.com/http-api-projects-taxCategories.html#taxrate
 * @method string getId()
 * @method TaxRate setId(string $id = null)
 * @method string getName()
 * @method TaxRate setName(string $name = null)
 * @method float getAmount()
 * @method TaxRate setAmount(float $amount = null)
 * @method bool getIncludedInPrice()
 * @method TaxRate setIncludedInPrice(bool $includedInPrice = null)
 * @method string getCountry()
 * @method TaxRate setCountry(string $country = null)
 * @method string getState()
 * @method TaxRate setState(string $state = null)
 * @method SubRateCollection getSubRates()
 * @method TaxRate setSubRates(SubRateCollection $subRates = null)
 */
class TaxRate extends JsonObject
{
    public function fieldDefinitions()
    {
        return [
            'id' => [self::TYPE => 'string', static::OPTIONAL => true],
            'name' => [self::TYPE => 'string'],
            'amount' => [self::TYPE => 'float'],
            'includedInPrice' => [self::TYPE => 'bool'],
            'country' => [self::TYPE => 'string'],
            'state' => [self::TYPE => 'string', static::OPTIONAL => true],
            'subRates' => [static::TYPE => SubRateCollection::class, static::OPTIONAL => true]
        ];
    }
}
