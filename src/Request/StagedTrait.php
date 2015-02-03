<?php
/**
 * @author @ct-jensschulze <jens.schulze@commercetools.de>
 * @created: 02.02.15, 15:03
 */

namespace Sphere\Core\Request;


/**
 * Class StagedTrait
 * @package Sphere\Core\Request
 * @method $this addParam($key, $value)
 */
trait StagedTrait
{
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
