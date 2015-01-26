<?php
/**
 * @author @ct-jensschulze <jens.schulze@commercetools.de>
 * @created: 26.01.15, 11:51
 */

namespace Sphere\Core\Request;


interface ParamInterface
{
    public function addParam($key, $value);
}
