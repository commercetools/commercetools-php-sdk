<?php
/**
 * @author @jayS-de <jens.schulze@commercetools.de>
 */

namespace Commercetools\Core\Model\Common;

use Commercetools\Core\Model\CustomField\CustomFieldObject;

/**
 * @package Commercetools\Core\Model\Common
 *
 * @method string getId()
 * @method Asset setId(string $id = null)
 * @method AssetSourceCollection getSources()
 * @method Asset setSources(AssetSourceCollection $sources = null)
 * @method LocalizedString getName()
 * @method Asset setName(LocalizedString $name = null)
 * @method LocalizedString getDescription()
 * @method Asset setDescription(LocalizedString $description = null)
 * @method array getTags()
 * @method Asset setTags(array $tags = null)
 * @method CustomFieldObject getCustom()
 * @method Asset setCustom(CustomFieldObject $custom = null)
 */
class Asset extends JsonObject
{
    public function fieldDefinitions()
    {
        return [
            'id' => [static::TYPE => 'string'],
            'sources' => [static::TYPE => '\Commercetools\Core\Model\Common\AssetSourceCollection'],
            'name' => [static::TYPE => '\Commercetools\Core\Model\Common\LocalizedString'],
            'description' => [static::TYPE => '\Commercetools\Core\Model\Common\LocalizedString'],
            'tags' => [static::TYPE => 'array'],
            'custom' => [static::TYPE => '\Commercetools\Core\Model\CustomField\CustomFieldObject'],
        ];
    }
}
