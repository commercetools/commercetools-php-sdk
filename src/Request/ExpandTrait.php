<?php
/**
 * @author @ct-jensschulze <jens.schulze@commercetools.de>
 */

namespace Sphere\Core\Request;

use Sphere\Core\Request\Query\MultiParameter;
use Sphere\Core\Request\Query\ParameterInterface;

/**
 * @package Sphere\Core\Request
 * @method $this addParamObject(ParameterInterface $param)
 */
trait ExpandTrait
{
    /**
     * @param $fieldReference
     * @return $this
     */
    public function expand($fieldReference)
    {
        $this->addParamObject(new MultiParameter('expand', $fieldReference));

        return $this;
    }
}
