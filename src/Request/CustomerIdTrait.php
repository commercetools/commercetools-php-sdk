<?php
/**
 * @author @ct-jensschulze <jens.schulze@commercetools.de>
 */

namespace Sphere\Core\Request;

/**
 * Class CustomerIdTrait
 * @package Sphere\Core\Request
 * @method $this addParam($key, $value)
 */
trait CustomerIdTrait
{
    public function byCustomerId($customerId)
    {
        if (!is_null($customerId)) {
            $this->addParam('customerId', $customerId);
        }

        return $this;
    }
}
