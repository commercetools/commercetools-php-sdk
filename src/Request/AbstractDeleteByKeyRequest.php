<?php
/**
 * @author @jayS-de <jens.schulze@commercetools.de>
 * @created: 26.01.15, 17:22
 */

namespace Commercetools\Core\Request;

use Psr\Http\Message\ResponseInterface;
use Commercetools\Core\Client;
use Commercetools\Core\Client\HttpMethod;
use Commercetools\Core\Client\HttpRequest;
use Commercetools\Core\Client\JsonEndpoint;
use Commercetools\Core\Model\Common\Context;
use Commercetools\Core\Request\Query\Parameter;
use Commercetools\Core\Response\ResourceResponse;

/**
 * @package Commercetools\Core\Request
 * @method ResourceResponse executeWithClient(Client $client)
 */
abstract class AbstractDeleteByKeyRequest extends AbstractDeleteRequest
{
    use ExpandTrait;

    /**
     * @return string
     */
    public function getKey()
    {
        return $this->getId();
    }

    /**
     * @param $key
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
