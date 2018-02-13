<?php
/**
 * @author @jenschude <jens.schulze@commercetools.de>
 */

namespace Commercetools\Core\Request;

use Commercetools\Core\Request\Query\Parameter;
use Commercetools\Core\Request\Query\ParameterInterface;

/**
 * @package Commercetools\Core\Request
 */
trait WithTotalTrait
{
    /**
     * @param ParameterInterface $param
     * @return $this
     */
    abstract public function addParamObject(ParameterInterface $param);

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
