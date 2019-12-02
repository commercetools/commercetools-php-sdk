<?php
/**
 * @author @jenschude <jens.schulze@commercetools.de>
 * @created: 26.01.15, 14:26
 */

namespace Commercetools\Core\Request;

use Commercetools\Core\Request\Query\MultiParameter;
use Commercetools\Core\Request\Query\ParameterInterface;

/**
 * @package Commercetools\Core\Request
 */
trait QueryTrait
{
    /**
     * @param ParameterInterface $param
     * @return $this
     */
    abstract public function addParamObject(ParameterInterface $param);

    /**
     * @param string $where
     * @param array $params
     * @return $this
     */
    public function where($where, array $params = [])
    {
        if (!is_null($where)) {
            $this->addParamObject(new MultiParameter('where', $where));
            foreach ($params as $paramName => $paramValue) {
                $this->addParam($paramName, $paramValue);
            }
        }

        return $this;
    }
}
