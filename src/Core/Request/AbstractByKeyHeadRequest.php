<?php

namespace Commercetools\Core\Request;

use Commercetools\Core\Client;
use Commercetools\Core\Response\ResourceResponse;

/**
 * @package Commercetools\Core\Request
 * @method ResourceResponse executeWithClient(Client $client)
 */
abstract class AbstractByKeyHeadRequest extends AbstractByIdHeadRequest
{
    /**
     * @return string
     */
    public function getKey()
    {
        return $this->getId();
    }

    /**
     * @param string $key
     * @return $this
     */
    public function setKey($key)
    {
        return $this->setId($key);
    }

    /**
     * @return string
     * @internal
     */
    protected function getPath()
    {
        return (string)$this->getEndpoint() . '/key=' . $this->getKey() . $this->getParamString();
    }
}
