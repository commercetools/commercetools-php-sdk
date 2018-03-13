<?php
/**
 * @author @jenschude <jens.schulze@commercetools.de>
 */

namespace Commercetools\Core\Request;

use Commercetools\Core\Request\Query\Parameter;
use Commercetools\Core\Request\Query\ParameterInterface;

/**
 * @package Commercetools\Core\Request
 */
trait CustomerIdTrait
{
    /**
     * @param ParameterInterface $param
     * @return $this
     */
    abstract public function addParamObject(ParameterInterface $param);

    public function byCustomerId($customerId)
    {
        if (!is_null($customerId)) {
            $this->addParamObject(new Parameter('customerId', $customerId));
        }

        return $this;
    }
}
