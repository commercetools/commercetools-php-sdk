<?php
/**
 * @author @jayS-de <jens.schulze@commercetools.de>
 * @created: 27.01.15, 14:53
 */

namespace Commercetools\Core\Model\Common;

/**
 * @package Commercetools\Core\Model\Common
 * @link https://dev.commercetools.com/http-api-types.html#reference
 * @method string getTypeId()
 * @method string getId()
 * @method Reference setTypeId(string $typeId = null)
 * @method Reference setId(string $id = null)
 * @method JsonObject getObj()
 * @method Reference setObj(JsonObject $obj = null)
 * @method string getKey()
 * @method Reference setKey(string $key = null)
 */
class Reference extends ResourceIdentifier
{
    const OBJ = 'obj';

    const TYPE_CLASS = '\Commercetools\Core\Model\Common\JsonObject';

    public function fieldDefinitions()
    {
        $fieldDefinitions = parent::fieldDefinitions();
        $fieldDefinitions[static::OBJ] = [static::TYPE => static::TYPE_CLASS];

        return $fieldDefinitions;
    }
}
