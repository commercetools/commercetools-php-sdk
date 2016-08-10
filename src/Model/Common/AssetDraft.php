<?php
/**
 * @author @jayS-de <jens.schulze@commercetools.de>
 */

namespace Commercetools\Core\Model\Common;

use Commercetools\Core\Model\CustomField\CustomFieldObject;

/**
 * @package Commercetools\Core\Model\Common
 *
 * @method AssetSourceCollection getSources()
 * @method AssetDraft setSources(AssetSourceCollection $sources = null)
 * @method LocalizedString getName()
 * @method AssetDraft setName(LocalizedString $name = null)
 * @method LocalizedString getDescription()
 * @method AssetDraft setDescription(LocalizedString $description = null)
 * @method array getTags()
 * @method AssetDraft setTags(array $tags = null)
 * @method CustomFieldObject getCustom()
 * @method AssetDraft setCustom(CustomFieldObject $custom = null)
 */
class AssetDraft extends JsonObject
{
    public function fieldDefinitions()
    {
        return [
            'sources' => [static::TYPE => '\Commercetools\Core\Model\Common\AssetSourceCollection'],
            'name' => [static::TYPE => '\Commercetools\Core\Model\Common\LocalizedString'],
            'description' => [static::TYPE => '\Commercetools\Core\Model\Common\LocalizedString'],
            'tags' => [static::TYPE => 'array'],
            'custom' => [static::TYPE => '\Commercetools\Core\Model\CustomField\CustomFieldObject'],
        ];
    }
}
