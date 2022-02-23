<?php
/**
 * @author @jenschude <jens.schulze@commercetools.de>
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
 * @method string getKey()
 * @method Asset setKey(string $key = null)
 */
class Asset extends JsonObject
{
    public function fieldDefinitions()
    {
        return [
            'id' => [static::TYPE => 'string'],
            'key' => [static::TYPE => 'string', self::OPTIONAL => true],
            'sources' => [static::TYPE => AssetSourceCollection::class],
            'name' => [static::TYPE => LocalizedString::class],
            'description' => [static::TYPE => LocalizedString::class, self::OPTIONAL => true],
            'tags' => [static::TYPE => 'array', self::OPTIONAL => true],
            'custom' => [static::TYPE => CustomFieldObject::class, self::OPTIONAL => true],
        ];
    }
}
