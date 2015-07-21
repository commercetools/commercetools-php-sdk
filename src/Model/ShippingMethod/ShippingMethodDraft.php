<?php
/**
 * @author @ct-jensschulze <jens.schulze@commercetools.de>
 */

namespace Sphere\Core\Model\ShippingMethod;

use Sphere\Core\Model\Common\Context;
use Sphere\Core\Model\Common\JsonObject;
use Sphere\Core\Model\TaxCategory\TaxCategoryReference;

/**
 * @package Sphere\Core\Model\ShippingMethod
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
 */
class ShippingMethodDraft extends JsonObject
{
    public function getFields()
    {
        return [
            'name' => [static::TYPE => 'string'],
            'description' => [static::TYPE => 'string'],
            'taxCategory' => [static::TYPE => '\Sphere\Core\Model\TaxCategory\TaxCategoryReference'],
            'zoneRates' => [static::TYPE => '\Sphere\Core\Model\ShippingMethod\ZoneRateCollection'],
            'isDefault' => [static::TYPE => 'bool'],
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
