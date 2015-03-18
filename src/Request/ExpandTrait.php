<?php
/**
 * @author @ct-jensschulze <jens.schulze@commercetools.de>
 */

namespace Sphere\Core\Request;

/**
 * Class ExpandTrait
 * @package Sphere\Core\Request
 * @method $this addParam($key, $value)
 */
trait ExpandTrait
{
    /**
     * @param string $fieldReference
     */
    public function expand($fieldReference)
    {
        $this->addParam('expand', $fieldReference);
    }
}
