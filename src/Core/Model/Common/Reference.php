<?php
/**
 * @author @jenschude <jens.schulze@commercetools.de>
 * @created: 27.01.15, 14:53
 */

namespace Commercetools\Core\Model\Common;

/**
 * @package Commercetools\Core\Model\Common
 * @ramlTestIgnoreFields('obj', 'key')
 * @link https://docs.commercetools.com/http-api-types.html#reference
 * @method string getTypeId()
 * @method string getId()
 * @method Reference setTypeId(string $typeId = null)
 * @method Reference setId(string $id = null)
 * @method JsonObject getObj()
 * @method Reference setObj(JsonObject $obj = null)
 * @method string getKey()
 * @method Reference setKey(string $key = null)
 */
class Reference extends KeyReference
{
    const OBJ = 'obj';

    const TYPE_CLASS = JsonObject::class;

    public function fieldDefinitions()
    {
        return [
            static::TYPE_ID => [self::TYPE => 'string'],
            static::ID => [self::TYPE => 'string'],
            static::KEY => [self::TYPE => 'string', static::OPTIONAL => true],
            static::OBJ => [static::TYPE => static::TYPE_CLASS, static::OPTIONAL => true]
        ];
    }
}
