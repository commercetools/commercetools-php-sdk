<?php
/**
 * @author @ct-jensschulze <jens.schulze@commercetools.de>
 * @created: 27.01.15, 18:22
 */

namespace Sphere\Core\Model\State;

use Sphere\Core\Model\Common\Context;
use Sphere\Core\Model\Common\Reference;
use Sphere\Core\Model\Common\ReferenceFromArrayTrait;

/**
 * Class StateReference
 * @package Sphere\Core\Model\State
 * @method static StateReference of(string $id)
 * @method string getTypeId()
 * @method StateReference setTypeId(string $typeId)
 * @method string getId()
 * @method StateReference setId(string $id)
 * @method array getObj()
 * @method StateReference setObj(array $obj)
 */
class StateReference extends Reference
{
    use ReferenceFromArrayTrait;

    const TYPE_STATE = 'state';

    /**
     * @param string $id
     * @param Context $context
     */
    public function __construct($id, Context $context = null)
    {
        parent::__construct(static::TYPE_STATE, $id, $context);
    }
}
