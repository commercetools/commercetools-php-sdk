<?php
/**
 * @author @ct-jensschulze <jens.schulze@commercetools.de>
 */

namespace Commercetools\Core\Request;

use Commercetools\Core\Request\Query\Parameter;
use Commercetools\Core\Request\Query\ParameterInterface;

/**
 * @package Commercetools\Core\Request
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
