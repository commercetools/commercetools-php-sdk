<?php
/**
 * @author @ct-jensschulze <jens.schulze@commercetools.de>
 */

namespace Commercetools\Core\Request;

use Commercetools\Core\Request\Query\MultiParameter;
use Commercetools\Core\Request\Query\ParameterInterface;

/**
 * @package Commercetools\Core\Request
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
