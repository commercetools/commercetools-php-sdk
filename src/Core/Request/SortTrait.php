<?php
/**
 * @author @jenschude <jens.schulze@commercetools.de>
 * @created: 27.01.15, 10:40
 */

namespace Commercetools\Core\Request;

use Commercetools\Core\Request\Query\MultiParameter;
use Commercetools\Core\Request\Query\OrderedMultiParameter;
use Commercetools\Core\Request\Query\ParameterInterface;

/**
 * @package Commercetools\Core\Request
 */
trait SortTrait
{
    /**
     * @param ParameterInterface $param
     * @return $this
     */
    abstract public function addParamObject(ParameterInterface $param);

    abstract public function getParamCount();
    /**
     * @param string $sort
     * @return $this
     */
    public function sort($sort)
    {
        if (!is_null($sort)) {
            $this->addParamObject(new OrderedMultiParameter('sort', $sort, $this->getParamCount()));
        }

        return $this;
    }
}
