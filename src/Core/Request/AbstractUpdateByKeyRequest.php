<?php
/**
 * @author @jenschude <jens.schulze@commercetools.de>
 * @created: 26.01.15, 17:22
 */

namespace Commercetools\Core\Request;

use Psr\Http\Message\ResponseInterface;
use Commercetools\Core\Client\HttpMethod;
use Commercetools\Core\Client\JsonEndpoint;
use Commercetools\Core\Client\JsonRequest;
use Commercetools\Core\Error\Message;
use Commercetools\Core\Model\Common\Context;
use Commercetools\Core\Model\Common\ContextAwareInterface;
use Commercetools\Core\Response\ResourceResponse;
use Commercetools\Core\Error\UpdateActionLimitException;

/**
 * @package Commercetools\Core\Request
 */
abstract class AbstractUpdateByKeyRequest extends AbstractUpdateRequest
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
        return (string)$this->getEndpoint() . '/key=' . $this->getId() . $this->getParamString();
    }
}
