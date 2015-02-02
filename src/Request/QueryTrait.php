<?php
/**
 * @author @ct-jensschulze <jens.schulze@commercetools.de>
 * @created: 26.01.15, 14:26
 */

namespace Sphere\Core\Request;

/**
 * Class QueryTrait
 * @package Sphere\Core\Request
 */
trait QueryTrait
{
    /**
     * @param $key
     * @param $value
     * @return $this
     */
    abstract public function addParam($key, $value);

    /**
     * @param string $where
     * @return $this
     */
    public function where($where)
    {
        if (!is_null($where)) {
            $this->addParam('where', $where);
        }

        return $this;
    }
}
