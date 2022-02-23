<?php
/**
 */

namespace Commercetools\Core\Model\Store;

use Commercetools\Core\Model\Channel\ChannelReference;
use Commercetools\Core\Model\Common\DateTimeDecorator;
use Commercetools\Core\Model\Common\LocalizedString;
use Commercetools\Core\Model\Common\Resource;
use Commercetools\Core\Model\CustomField\CustomFieldObject;
use DateTime;

/**
 * @package Commercetools\Core\Model\Store
 * @link https://docs.commercetools.com/http-api-projects-stores#store
 * @method string getId()
 * @method Store setId(string $id = null)
 * @method int getVersion()
 * @method Store setVersion(int $version = null)
 * @method string getKey()
 * @method Store setKey(string $key = null)
 * @method LocalizedString getName()
 * @method Store setName(LocalizedString $name = null)
 * @method DateTimeDecorator getCreatedAt()
 * @method Store setCreatedAt(DateTime $createdAt = null)
 * @method DateTimeDecorator getLastModifiedAt()
 * @method Store setLastModifiedAt(DateTime $lastModifiedAt = null)
 * @method array getLanguages()
 * @method Store setLanguages(array $languages = null)
 * @method ChannelReference getDistributionChannel()
 * @method Store setDistributionChannel(ChannelReference $distributionChannel = null)
 * @method ChannelReference getSupplyChannel()
 * @method Store setSupplyChannel(ChannelReference $supplyChannel = null)
 * @method array getDistributionChannels()
 * @method Store setDistributionChannels(array $distributionChannels = null)
 * @method array getSupplyChannels()
 * @method Store setSupplyChannels(array $supplyChannels = null)
 * @method CustomFieldObject getCustom()
 * @method Store setCustom(CustomFieldObject $custom = null)
 * @method array getProductSelections()
 * @method Store setProductSelections(array $productSelections = null)
 * @method StoreReference getReference()
 */
class Store extends Resource
{
    public function fieldDefinitions()
    {
        return [
            'id' => [static::TYPE => 'string'],
            'version' => [static::TYPE => 'int'],
            'key' => [static::TYPE => 'string'],
            'name' => [static::TYPE => LocalizedString::class, static::OPTIONAL => true],
            'createdAt' => [
                static::TYPE => DateTime::class,
                static::DECORATOR => DateTimeDecorator::class
            ],
            'lastModifiedAt' => [
                static::TYPE => DateTime::class,
                static::DECORATOR => DateTimeDecorator::class
            ],
            'languages' => [static::TYPE => 'array', static::OPTIONAL => true],
            'distributionChannels' => [static::TYPE => 'array'],
            'supplyChannels' => [static::TYPE => 'array', static::OPTIONAL => true],
            'productSelections' => [static::TYPE => 'array', static::OPTIONAL => true],
            'custom' => [static::TYPE => CustomFieldObject::class, static::OPTIONAL => true],
        ];
    }
}
