<?php
/**
 * @author @ct-jensschulze <jens.schulze@commercetools.de>
 */

namespace Commercetools\Core\Model\ShippingMethod;

use Commercetools\Core\Model\Common\Resource;
use Commercetools\Core\Model\TaxCategory\TaxCategoryReference;

/**
 * @package Commercetools\Core\Model\ShippingMethod
 * @apidoc http://dev.sphere.io/http-api-projects-shippingMethods.html#shipping-method
 * @method string getId()
 * @method ShippingMethod setId(string $id = null)
 * @method int getVersion()
 * @method ShippingMethod setVersion(int $version = null)
 * @method \DateTime getCreatedAt()
 * @method ShippingMethod setCreatedAt(\DateTime $createdAt = null)
 * @method \DateTime getLastModifiedAt()
 * @method ShippingMethod setLastModifiedAt(\DateTime $lastModifiedAt = null)
 * @method string getName()
 * @method ShippingMethod setName(string $name = null)
 * @method string getDescription()
 * @method ShippingMethod setDescription(string $description = null)
 * @method TaxCategoryReference getTaxCategory()
 * @method ShippingMethod setTaxCategory(TaxCategoryReference $taxCategory = null)
 * @method ZoneRateCollection getZoneRates()
 * @method ShippingMethod setZoneRates(ZoneRateCollection $zoneRates = null)
 * @method bool getIsDefault()
 * @method ShippingMethod setIsDefault(bool $isDefault = null)
 */
class ShippingMethod extends Resource
{
    public function fieldDefinitions()
    {
        return [
            'id' => [static::TYPE => 'string'],
            'version' => [static::TYPE => 'int'],
            'createdAt' => [static::TYPE => '\DateTime'],
            'lastModifiedAt' => [static::TYPE => '\DateTime'],
            'name' => [static::TYPE => 'string'],
            'description' => [static::TYPE => 'string'],
            'taxCategory' => [static::TYPE => '\Commercetools\Core\Model\TaxCategory\TaxCategoryReference'],
            'zoneRates' => [static::TYPE => '\Commercetools\Core\Model\ShippingMethod\ZoneRateCollection'],
            'isDefault' => [static::TYPE => 'bool']
        ];
    }
}
