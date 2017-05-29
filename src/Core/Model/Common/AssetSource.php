<?php
/**
 * @author @jayS-de <jens.schulze@commercetools.de>
 */

namespace Commercetools\Core\Model\Common;

/**
 * @package Commercetools\Core\Model\Common
 *
 * @method string getUri()
 * @method AssetSource setUri(string $uri = null)
 * @method string getKey()
 * @method AssetSource setKey(string $key = null)
 * @method AssetDimension getDimensions()
 * @method AssetSource setDimensions(AssetDimension $dimensions = null)
 * @method string getContentType()
 * @method AssetSource setContentType(string $contentType = null)
 */
class AssetSource extends JsonObject
{
    public function fieldDefinitions()
    {
        return [
            'uri' => [static::TYPE => 'string'],
            'key' => [static::TYPE => 'string'],
            'dimensions' => [static::TYPE => AssetDimension::class],
            'contentType' => [static::TYPE => 'string'],
        ];
    }
}
