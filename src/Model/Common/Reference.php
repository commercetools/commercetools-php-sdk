<?php
/**
 * @author @ct-jensschulze <jens.schulze@commercetools.de>
 * @created: 27.01.15, 14:53
 */

namespace Sphere\Core\Model\Common;


/**
 * @package Sphere\Core\Model\Common
 * @apidoc http://dev.sphere.io/http-api-types.html#reference
 * @method string getTypeId()
 * @method string getId()
 * @method Reference setTypeId(string $typeId = null)
 * @method Reference setId(string $id = null)
 * @method JsonObject getObj()
 * @method Reference setObj(JsonObject $obj = null)
 */
class Reference extends JsonObject
{
    const TYPE_ID = 'typeId';
    const ID = 'id';
    const OBJ = 'obj';

    public function getFields()
    {
        return [
            static::TYPE_ID => [self::TYPE => 'string'],
            static::ID => [self::TYPE => 'string'],
            static::OBJ => [static::TYPE => '\Sphere\Core\Model\Common\JsonObject']
        ];
    }

    /**
     * @param $type
     * @param $id
     * @param Context|callable $context
     * @return Reference
     */
    public static function ofTypeAndId($type, $id, $context = null)
    {
        $reference = static::of($context);
        return $reference->setTypeId($type)->setId($id);
    }

    public function jsonSerialize()
    {
        $data = parent::jsonSerialize();
        unset($data['obj']);

        return $data;
    }
}
