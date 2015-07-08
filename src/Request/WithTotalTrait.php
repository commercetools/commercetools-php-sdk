<?php
/**
 * @author @ct-jensschulze <jens.schulze@commercetools.de>
 */

namespace Sphere\Core\Request;

use Sphere\Core\Request\Query\Parameter;
use Sphere\Core\Request\Query\ParameterInterface;

/**
 * Class WithTotalTrait
 * @package Sphere\Core\Request
 * @method $this addParamObject(ParameterInterface $param)
 */
trait WithTotalTrait
{
    /**
     * @param bool $withTotal
     * @return $this
     */
    public function withTotal($withTotal)
    {
        if (is_bool($withTotal)) {
            $this->addParamObject(new Parameter('withTotal', $withTotal));
        }

        return $this;
    }
}
