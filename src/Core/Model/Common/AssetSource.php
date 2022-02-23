<?php
/**
 * @author @jenschude <jens.schulze@commercetools.de>
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
            'key' => [static::TYPE => 'string', self::OPTIONAL => true],
            'dimensions' => [static::TYPE => AssetDimension::class, self::OPTIONAL => true],
            'contentType' => [static::TYPE => 'string', self::OPTIONAL => true],
        ];
    }
}
