<?php
/**
 * @author @jenschude <jens.schulze@commercetools.de>
 */

namespace Commercetools\Core\Model\ShippingMethod;

use Commercetools\Core\Model\Common\Context;
use Commercetools\Core\Model\Common\JsonObject;
use Commercetools\Core\Model\Common\LocalizedString;
use Commercetools\Core\Model\CustomField\CustomFieldObjectDraft;
use Commercetools\Core\Model\TaxCategory\TaxCategoryReference;

/**
 * @package Commercetools\Core\Model\ShippingMethod
 * @link https://docs.commercetools.com/http-api-projects-shippingMethods.html#shippingmethoddraft
 * @method string getName()
 * @method ShippingMethodDraft setName(string $name = null)
 * @method string getDescription()
 * @method ShippingMethodDraft setDescription(string $description = null)
 * @method TaxCategoryReference getTaxCategory()
 * @method ShippingMethodDraft setTaxCategory(TaxCategoryReference $taxCategory = null)
 * @method ZoneRateCollection getZoneRates()
 * @method ShippingMethodDraft setZoneRates(ZoneRateCollection $zoneRates = null)
 * @method bool getIsDefault()
 * @method ShippingMethodDraft setIsDefault(bool $isDefault = null)
 * @method string getKey()
 * @method ShippingMethodDraft setKey(string $key = null)
 * @method string getPredicate()
 * @method ShippingMethodDraft setPredicate(string $predicate = null)
 * @method LocalizedString getLocalizedDescription()
 * @method ShippingMethodDraft setLocalizedDescription(LocalizedString $localizedDescription = null)
 * @method CustomFieldObjectDraft getCustom()
 * @method ShippingMethodDraft setCustom(CustomFieldObjectDraft $custom = null)
 */
class ShippingMethodDraft extends JsonObject
{
    public function fieldDefinitions()
    {
        return [
            'name' => [static::TYPE => 'string'],
            'localizedDescription' => [static::TYPE => LocalizedString::class],
            'description' => [static::TYPE => 'string'],
            'taxCategory' => [static::TYPE => TaxCategoryReference::class],
            'zoneRates' => [static::TYPE => ZoneRateCollection::class],
            'isDefault' => [static::TYPE => 'bool'],
            'key' => [static::TYPE => 'string'],
            'predicate' => [static::TYPE => 'string'],
            'custom' => [static::TYPE => CustomFieldObjectDraft::class],
        ];
    }

    /**
     * @param string $name
     * @param TaxCategoryReference $taxCategory
     * @param ZoneRateCollection $zoneRates
     * @param bool $isDefault
     * @param Context|callable $context
     * @return ShippingMethodDraft
     */
    public static function ofNameTaxCategoryZoneRateAndDefault(
        $name,
        TaxCategoryReference $taxCategory,
        ZoneRateCollection $zoneRates,
        $isDefault,
        $context = null
    ) {
        return static::of($context)
            ->setName($name)
            ->setTaxCategory($taxCategory)
            ->setZoneRates($zoneRates)
            ->setIsDefault($isDefault);
    }
}
