<?php
/**
 * @author @ct-jensschulze <jens.schulze@commercetools.de>
 */

namespace Commercetools\Core\Model\Common;

/**
 * @package Commercetools\Core\Model\Common
 *
 * @method string getTypeId()
 * @method ResourceIdentifier setTypeId(string $typeId = null)
 * @method string getId()
 * @method ResourceIdentifier setId(string $id = null)
 * @method string getKey()
 * @method ResourceIdentifier setKey(string $key = null)
 */
abstract class ResourceIdentifier extends JsonObject
{
    const TYPE_ID = 'typeId';
    const ID = 'id';
    const KEY = 'key';

    public function fieldDefinitions()
    {
        return [
            static::TYPE_ID => [self::TYPE => 'string'],
            static::ID => [self::TYPE => 'string'],
            static::KEY => [self::TYPE => 'string']
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

    /**
     * @param $type
     * @param $key
     * @param Context|callable $context
     * @return Reference
     */
    public static function ofTypeAndKey($type, $key, $context = null)
    {
        $reference = static::of($context);
        return $reference->setTypeId($type)->setKey($key);
    }

    public function jsonSerialize()
    {
        $data = parent::jsonSerialize();
        unset($data['obj']);

        return $data;
    }
}
