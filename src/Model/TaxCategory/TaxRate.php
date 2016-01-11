<?php
/**
 * @author @jayS-de <jens.schulze@commercetools.de>
 */

namespace Commercetools\Core\Model\TaxCategory;

use Commercetools\Core\Model\Common\JsonObject;

/**
 * @package Commercetools\Core\Model\TaxCategory
 * @apidoc http://dev.sphere.io/http-api-projects-taxCategories.html#tax-rate
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
 */
class TaxRate extends JsonObject
{
    public function fieldDefinitions()
    {
        return [
            'id' => [self::TYPE => 'string'],
            'name' => [self::TYPE => 'string'],
            'amount' => [self::TYPE => 'float'],
            'includedInPrice' => [self::TYPE => 'bool'],
            'country' => [self::TYPE => 'string'],
            'state' => [self::TYPE => 'string']
        ];
    }
}
