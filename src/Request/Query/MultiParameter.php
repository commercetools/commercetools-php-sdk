<?php
/**
 * @author @ct-jensschulze <jens.schulze@commercetools.de>
 */

namespace Sphere\Core\Request\Query;


class MultiParameter extends Parameter
{
    public function getId()
    {
        return $this->__toString();
    }
}
