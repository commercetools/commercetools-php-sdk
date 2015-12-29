<?php
/**
 * @author @jayS-de <jens.schulze@commercetools.de>
 * @created: 27.01.15, 14:53
 */

namespace Commercetools\Core\Model\Common;

/**
 * @package Commercetools\Core\Model\Common
 * @apidoc http://dev.sphere.io/http-api-types.html#reference
 * @method string getTypeId()
 * @method string getId()
 * @method Reference setTypeId(string $typeId = null)
 * @method Reference setId(string $id = null)
 * @method JsonObject getObj()
 * @method Reference setObj(JsonObject $obj = null)
 */
class Reference extends ResourceIdentifier
{
    const OBJ = 'obj';

    public function fieldDefinitions()
    {
        $fieldDefinitions = parent::fieldDefinitions();
        $fieldDefinitions[static::OBJ] = [static::TYPE => '\Commercetools\Core\Model\Common\JsonObject'];

        return $fieldDefinitions;
    }

    public function jsonSerialize()
    {
        $data = parent::jsonSerialize();
        unset($data['obj']);

        return $data;
    }

    /**
     * @internal
     * @return null
     */
    public function getKey()
    {
        return null;
    }

    /**
     * @internal
     * @param null $key
     * @return $this
     */
    public function setKey($key = null)
    {
        return $this;
    }
}
