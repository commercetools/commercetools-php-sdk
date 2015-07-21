<?php
/**
 * @author @ct-jensschulze <jens.schulze@commercetools.de>
 * @created: 27.01.15, 18:22
 */

namespace Sphere\Core\Model\State;

use Sphere\Core\Model\Common\Context;
use Sphere\Core\Model\Common\Reference;

/**
 * @package Sphere\Core\Model\State
 * @link http://dev.sphere.io/http-api-types.html#reference
 * @method string getTypeId()
 * @method StateReference setTypeId(string $typeId = null)
 * @method string getId()
 * @method StateReference setId(string $id = null)
 * @method State getObj()
 * @method StateReference setObj(State $obj = null)
 */
class StateReference extends Reference
{
    const TYPE_STATE = 'state';

    public function getFields()
    {
        $fields = parent::getFields();
        $fields[static::OBJ] = [static::TYPE => '\Sphere\Core\Model\State\State'];

        return $fields;
    }


    /**
     * @param $id
     * @param Context|callable $context
     * @return StateReference
     */
    public static function ofId($id, $context = null)
    {
        return static::ofTypeAndId(static::TYPE_STATE, $id, $context);
    }
}
