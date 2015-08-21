<?php
/**
 * @author @ct-jensschulze <jens.schulze@commercetools.de>
 */

namespace Commercetools\Core\Model\Type;

use Commercetools\Core\Model\Common\Context;
use Commercetools\Core\Model\Common\Reference;
use Commercetools\Core\Model\Common\JsonObject;

/**
 * @package Commercetools\Core\Model\Type
 * @method string getTypeId()
 * @method TypeReference setTypeId(string $typeId = null)
 * @method string getId()
 * @method TypeReference setId(string $id = null)
 * @method Type getObj()
 * @method TypeReference setObj(Type $obj = null)
 */
class TypeReference extends Reference
{
    const TYPE_TYPE = 'type';

    public function fieldDefinitions()
    {
        $fields = parent::fieldDefinitions();
        $fields[static::OBJ] = [static::TYPE => '\Commercetools\Core\Model\Type\Type'];

        return $fields;
    }

    /**
     * @param $id
     * @param Context|callable $context
     * @return TypeReference
     */
    public static function ofId($id, $context = null)
    {
        return static::ofTypeAndId(static::TYPE_TYPE, $id, $context);
    }
}
