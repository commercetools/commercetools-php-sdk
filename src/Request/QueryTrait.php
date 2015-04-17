<?php
/**
 * @author @ct-jensschulze <jens.schulze@commercetools.de>
 * @created: 26.01.15, 14:26
 */

namespace Sphere\Core\Request;

use Sphere\Core\Request\Query\Parameter;
use Sphere\Core\Request\Query\ParameterInterface;

/**
 * Class QueryTrait
 * @package Sphere\Core\Request
 * @method $this addParamObject(ParameterInterface $param)
 */
trait QueryTrait
{
    /**
     * @param string $where
     * @return $this
     */
    public function where($where)
    {
        if (!is_null($where)) {
            $this->addParamObject(new Parameter('where', $where));
        }

        return $this;
    }
}
