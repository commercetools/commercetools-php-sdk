<?php
/**
 */

namespace Commercetools\Core\Request;

use Commercetools\Core\Request\Query\Parameter;
use Commercetools\Core\Request\Query\ParameterInterface;

/**
 * @package Commercetools\Core\Request
 */
trait DataErasureTrait
{
    /**
     * @param ParameterInterface $param
     * @return $this
     */
    abstract public function addParamObject(ParameterInterface $param);

    /**
     * @param bool $dataErasure
     * @return $this
     */
    public function dataErasure($dataErasure)
    {
        if (is_bool($dataErasure)) {
            $this->addParamObject(new Parameter('dataErasure', $dataErasure));
        }

        return $this;
    }
}
