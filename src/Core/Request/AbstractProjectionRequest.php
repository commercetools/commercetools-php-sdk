<?php
/**
 * @author @jenschude <jens.schulze@commercetools.de>
 * @created: 02.02.15, 11:44
 */

namespace Commercetools\Core\Request;

use Commercetools\Core\Client\HttpRequest;
use Commercetools\Core\Client\HttpMethod;
use Commercetools\Core\Model\Common\Collection;
use Commercetools\Core\Model\Common\Context;
use Commercetools\Core\Model\Common\JsonDeserializeInterface;
use Commercetools\Core\Model\Common\JsonObject;

/**
 * @package Commercetools\Core\Request
 */
abstract class AbstractProjectionRequest extends AbstractApiRequest
{
    use StagedTrait;

    /**
     * @return string
     */
    abstract protected function getProjectionAction();

    /**
     * @return string
     * @internal
     */
    protected function getPath()
    {
        return (string)$this->getEndpoint() . '/' . $this->getProjectionAction() . $this->getParamString();
    }

    /**
     * @return HttpRequest
     * @internal
     */
    public function httpRequest()
    {
        return new HttpRequest(HttpMethod::GET, $this->getPath());
    }
}
