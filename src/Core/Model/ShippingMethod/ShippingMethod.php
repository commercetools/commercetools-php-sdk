<?php
/**
 * @author @jenschude <jens.schulze@commercetools.de>
 */

namespace Commercetools\Core\Model\ShippingMethod;

use Commercetools\Core\Model\Common\LocalizedString;
use Commercetools\Core\Model\Common\Resource;
use Commercetools\Core\Model\CustomField\CustomFieldObject;
use Commercetools\Core\Model\TaxCategory\TaxCategoryReference;
use Commercetools\Core\Model\Common\DateTimeDecorator;
use DateTime;

/**
 * @package Commercetools\Core\Model\ShippingMethod
 * @link https://docs.commercetools.com/http-api-projects-shippingMethods.html#shippingmethod
 * @method string getId()
 * @method ShippingMethod setId(string $id = null)
 * @method int getVersion()
 * @method ShippingMethod setVersion(int $version = null)
 * @method DateTimeDecorator getCreatedAt()
 * @method ShippingMethod setCreatedAt(DateTime $createdAt = null)
 * @method DateTimeDecorator getLastModifiedAt()
 * @method ShippingMethod setLastModifiedAt(DateTime $lastModifiedAt = null)
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
 * @method string getKey()
 * @method ShippingMethod setKey(string $key = null)
 * @method string getPredicate()
 * @method ShippingMethod setPredicate(string $predicate = null)
 * @method LocalizedString getLocalizedDescription()
 * @method ShippingMethod setLocalizedDescription(LocalizedString $localizedDescription = null)
 * @method LocalizedString getLocalizedName()
 * @method ShippingMethod setLocalizedName(LocalizedString $localizedName = null)
 * @method CustomFieldObject getCustom()
 * @method ShippingMethod setCustom(CustomFieldObject $custom = null)
 * @method ShippingMethodReference getReference()
 */
class ShippingMethod extends Resource
{
    public function fieldDefinitions()
    {
        return [
            'id' => [static::TYPE => 'string'],
            'version' => [static::TYPE => 'int'],
            'createdAt' => [
                static::TYPE => DateTime::class,
                static::DECORATOR => DateTimeDecorator::class
            ],
            'lastModifiedAt' => [
                static::TYPE => DateTime::class,
                static::DECORATOR => DateTimeDecorator::class
            ],
            'name' => [static::TYPE => 'string'],
            'localizedName' => [static::TYPE => LocalizedString::class, static::OPTIONAL => true],
            'localizedDescription' => [static::TYPE => LocalizedString::class, static::OPTIONAL => true],
            'description' => [static::TYPE => 'string', static::OPTIONAL => true],
            'taxCategory' => [static::TYPE => TaxCategoryReference::class],
            'zoneRates' => [static::TYPE => ZoneRateCollection::class],
            'isDefault' => [static::TYPE => 'bool'],
            'key' => [static::TYPE => 'string', static::OPTIONAL => true],
            'predicate' => [static::TYPE => 'string', static::OPTIONAL => true],
            'custom' => [static::TYPE => CustomFieldObject::class, static::OPTIONAL => true],
        ];
    }
}
