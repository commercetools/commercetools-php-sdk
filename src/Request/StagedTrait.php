<?php
/**
 * @author @ct-jensschulze <jens.schulze@commercetools.de>
 * @created: 02.02.15, 15:03
 */

namespace Sphere\Core\Request;

use Sphere\Core\Request\Query\Parameter;
use Sphere\Core\Request\Query\ParameterInterface;

/**
 * @package Sphere\Core\Request
 * @method $this addParamObject(ParameterInterface $param)
 */
trait StagedTrait
{
    /**
     * @param bool $staged
     * @return $this
     */
    public function staged($staged)
    {
        if (is_bool($staged)) {
            $this->addParamObject(new Parameter('staged', $staged));
        }

        return $this;
    }
}
