<?php
/**
 * @author @jenschude <jens.schulze@commercetools.de>
 */

namespace Commercetools\Core\Model\TaxCategory;

use Commercetools\Core\Model\Common\Context;
use Commercetools\Core\Model\Common\JsonObject;

/**
 * @package Commercetools\Core\Model\TaxCategory
 * @link https://docs.commercetools.com/http-api-projects-taxCategories.html#taxcategorydraft
 * @method string getName()
 * @method TaxCategoryDraft setName(string $name = null)
 * @method string getDescription()
 * @method TaxCategoryDraft setDescription(string $description = null)
 * @method TaxRateCollection getRates()
 * @method TaxCategoryDraft setRates(TaxRateCollection $rates = null)
 * @method string getKey()
 * @method TaxCategoryDraft setKey(string $key = null)
 */
class TaxCategoryDraft extends JsonObject
{
    public function fieldDefinitions()
    {
        return [
            'name' => [static::TYPE => 'string'],
            'description' => [static::TYPE => 'string', static::OPTIONAL => true],
            'rates' => [static::TYPE => TaxRateCollection::class, static::OPTIONAL => true],
            'key' => [self::TYPE => 'string', static::OPTIONAL => true],
        ];
    }

    /**
     * @param string $name
     * @param TaxRateCollection $rates
     * @param Context|callable $context
     * @return TaxCategoryDraft
     */
    public static function ofNameAndRates($name, TaxRateCollection $rates, $context = null)
    {
        return static::of($context)->setName($name)->setRates($rates);
    }
}
