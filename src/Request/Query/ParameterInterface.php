<?php
/**
 * @author @ct-jensschulze <jens.schulze@commercetools.de>
 */

namespace Sphere\Core\Request\Query;


interface ParameterInterface
{
    /**
     * @return string
     */
    public function getId();

    /**
     * @return string
     */
    public function __toString();
}
