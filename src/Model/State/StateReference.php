<?php
/**
 * @author @ct-jensschulze <jens.schulze@commercetools.de>
 * @created: 27.01.15, 18:22
 */

namespace Sphere\Core\Model\State;

use Sphere\Core\Model\Type\Reference;

/**
 * Class CategoryReference
 * @package Sphere\Core\Model\Type
 * @method static StateReference of(string $id)
 */
class StateReference extends Reference
{
    const TYPE_STATE = 'state';

    /**
     * @param string $id
     */
    public function __construct($id)
    {
        parent::__construct(static::TYPE_STATE, $id);
    }
}
