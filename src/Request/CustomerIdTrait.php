<?php
/**
 * @author @ct-jensschulze <jens.schulze@commercetools.de>
 */

namespace Sphere\Core\Request;

use Sphere\Core\Request\Query\Parameter;
use Sphere\Core\Request\Query\ParameterInterface;

/**
 * @package Sphere\Core\Request
 * @method $this addParamObject(ParameterInterface $param)
 */
trait CustomerIdTrait
{
    public function byCustomerId($customerId)
    {
        if (!is_null($customerId)) {
            $this->addParamObject(new Parameter('customerId', $customerId));
        }

        return $this;
    }
}
