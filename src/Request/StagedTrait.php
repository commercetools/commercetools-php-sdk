<?php
/**
 * @author @ct-jensschulze <jens.schulze@commercetools.de>
 * @created: 02.02.15, 15:03
 */

namespace Sphere\Core\Request;


/**
 * Class StagedTrait
 * @package Sphere\Core\Request
 */
trait StagedTrait
{
    /**
     * @param $key
     * @param $value
     * @return $this
     */
    abstract public function addParam($key, $value);

    /**
     * @param bool $staged
     * @return $this
     */
    public function staged($staged)
    {
        if (is_bool($staged)) {
            $this->addParam('staged', $staged);
        }

        return $this;
    }
}
