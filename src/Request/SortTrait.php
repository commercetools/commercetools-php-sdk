<?php
/**
 * @author @ct-jensschulze <jens.schulze@commercetools.de>
 * @created: 27.01.15, 10:40
 */

namespace Sphere\Core\Request;

/**
 * Class SortableTrait
 * @package Sphere\Core\Request
 */
trait SortTrait
{
    /**
     * @param $key
     * @param $value
     * @return $this
     */
    abstract public function addParam($key, $value);

    /**
     * @param string $sort
     * @return $this
     */
    public function sort($sort)
    {
        if (!is_null($sort)) {
            $this->addParam('sort', $sort);
        }

        return $this;
    }
}
