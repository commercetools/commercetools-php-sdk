<?php
/**
 * @author @ct-jensschulze <jens.schulze@commercetools.de>
 */

namespace Commercetools\Core\Request;

use Commercetools\Core\Request\Query\Parameter;
use Commercetools\Core\Request\Query\ParameterInterface;

/**
 * @package Commercetools\Core\Request
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
