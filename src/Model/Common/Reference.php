<?php
/**
 * @author @ct-jensschulze <jens.schulze@commercetools.de>
 * @created: 27.01.15, 14:53
 */

namespace Sphere\Core\Model\Common;


/**
 * Class Reference
 * @package Sphere\Core\Model\Common
 * @link http://dev.sphere.io/http-api-types.html#reference
 * @method static Reference of($typeId, $id)
 * @method string getTypeId()
 * @method string getId()
 * @method Reference setTypeId(string $typeId = null)
 * @method Reference setId(string $id = null)
 * @method JsonObject getObj()
 * @method Reference setObj(JsonObject $obj = null)
 */
class Reference extends JsonObject
{
    use OfTrait;

    public function getFields()
    {
        return [
            'typeId' => [self::TYPE => 'string'],
            'id' => [self::TYPE => 'string'],
            'obj' => [static::TYPE => '\Sphere\Core\Model\Common\JsonObject']
        ];
    }

    /**
     * @param string $typeId
     * @param string $id
     * @param Context|callable $context
     */
    public function __construct($typeId, $id, $context = null)
    {
        $this->setContext($context);
        $this->setTypeId($typeId);
        $this->setId($id);
    }

    /**
     * @param array $data
     * @param Context|callable $context
     * @return static
     */
    public static function fromArray(array $data, $context = null)
    {
        $reference = new static(
            $data['typeId'],
            $data['id'],
            $context
        );
        $reference->setRawData($data);

        return $reference;
    }

    public function jsonSerialize()
    {
        $data = parent::jsonSerialize();
        unset($data['obj']);

        return $data;
    }
}
