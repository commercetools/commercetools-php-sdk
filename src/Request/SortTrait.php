<?php
/**
 * @author @ct-jensschulze <jens.schulze@commercetools.de>
 * @created: 27.01.15, 10:40
 */

namespace Sphere\Core\Request;

use Sphere\Core\Request\Query\MultiParameter;
use Sphere\Core\Request\Query\ParameterInterface;

/**
 * @package Sphere\Core\Request
 * @method $this addParamObject(ParameterInterface $param)
 */
trait SortTrait
{
    /**
     * @param string $sort
     * @return $this
     */
    public function sort($sort)
    {
        if (!is_null($sort)) {
            $this->addParamObject(new MultiParameter('sort', $sort));
        }

        return $this;
    }
}
