<?php
/**
 * @author @jayS-de <jens.schulze@commercetools.de>
 * @created: 27.01.15, 18:22
 */

namespace Commercetools\Core\Model\State;

use Commercetools\Core\Model\Common\Context;
use Commercetools\Core\Model\Common\Reference;

/**
 * @package Commercetools\Core\Model\State
 * @apidoc http://dev.sphere.io/http-api-types.html#reference
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

    public function fieldDefinitions()
    {
        $fields = parent::fieldDefinitions();
        $fields[static::OBJ] = [static::TYPE => '\Commercetools\Core\Model\State\State'];

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
