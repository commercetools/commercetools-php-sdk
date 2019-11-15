<?php
/**
 * @author @jenschude <jens.schulze@commercetools.de>
 */

namespace Commercetools\Core\Model\Common;

use Commercetools\Core\Model\CustomField\CustomFieldObject;
use Commercetools\Core\Model\CustomField\CustomFieldObjectDraft;

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
 * @method CustomFieldObjectDraft getCustom()
 * @method AssetDraft setCustom(CustomFieldObjectDraft $custom = null)
 * @method string getKey()
 * @method AssetDraft setKey(string $key = null)
 */
class AssetDraft extends JsonObject
{
    public function fieldDefinitions()
    {
        return [
            'key' => [static::TYPE => 'string'],
            'sources' => [static::TYPE => AssetSourceCollection::class],
            'name' => [static::TYPE => LocalizedString::class],
            'description' => [static::TYPE => LocalizedString::class],
            'tags' => [static::TYPE => 'array'],
            'custom' => [static::TYPE => CustomFieldObjectDraft::class],
        ];
    }

    /**
     * @param AssetSource $sources
     * @param string $uri
     * @param LocalizedString $name
     * @param Context|callable $context
     * @return AssetDraft
     */
    public static function ofSourcesAndName(AssetSource $sources, $uri, LocalizedString $name, $context = null)
    {
        $sources->setUri($uri);
        return static::of($context)
            ->setSources(AssetSourceCollection::of()->add(
                AssetSource::of()->setUri($uri)
            ))
            ->setName($name);
    }
}
