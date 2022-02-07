<?php
/**
 */

namespace Commercetools\Core\Model\Store;

use Commercetools\Core\Model\Channel\ChannelReference;
use Commercetools\Core\Model\Common\Context;
use Commercetools\Core\Model\Common\JsonObject;
use Commercetools\Core\Model\Common\LocalizedString;
use Commercetools\Core\Model\CustomField\CustomFieldObject;
use Commercetools\Core\Model\CustomField\CustomFieldObjectDraft;

/**
 * @package Commercetools\Core\Model\Store
 * @link https://docs.commercetools.com/http-api-projects-stores#storedraft
 *
 *
 *
 * @method string getKey()
 * @method StoreDraft setKey(string $key = null)
 * @method LocalizedString getName()
 * @method StoreDraft setName(LocalizedString $name = null)
 * @method array getLanguages()
 * @method StoreDraft setLanguages(array $languages = null)
 * @method StoreDraft setDistributionChannel(ChannelReference $distributionChannel = null)
 * @method StoreDraft setSupplyChannel(ChannelReference $supplyChannel = null)
 * @method array getDistributionChannels()
 * @method StoreDraft setDistributionChannels(array $distributionChannels = null)
 * @method array getSupplyChannels()
 * @method StoreDraft setSupplyChannels(array $supplyChannels = null)
 * @method CustomFieldObjectDraft getCustom()
 * @method StoreDraft setCustom(CustomFieldObjectDraft $custom = null)
 * @method array getProductSelections()
 * @method StoreDraft setProductSelections(array $productSelections = null)
 */
class StoreDraft extends JsonObject
{
    public function fieldDefinitions()
    {
        return [
            'key' => [static::TYPE => 'string'],
            'name' => [static::TYPE => LocalizedString::class],
            'languages' => [static::TYPE => 'array'],
            'distributionChannels' => [static::TYPE => 'array'],
            'supplyChannels' => [static::TYPE => 'array'],
            'productSelections' => [static::TYPE => 'array'],
            'custom' => [static::TYPE => CustomFieldObjectDraft::class],
        ];
    }

    /**
     * @param string $key
     * @param Context|callable $context
     * @return StoreDraft
     */
    public static function ofKey($key, Context $context)
    {
        return static::of($context)->setKey($key);
    }

    /**
     * @param string $key
     * @param LocalizedString $name
     * @param Context|null $context
     * @return StoreDraft
     */
    public static function ofKeyAndName($key, LocalizedString $name, $context = null)
    {
        return static::of($context)->setKey($key)->setName($name);
    }
}
