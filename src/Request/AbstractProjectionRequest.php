<?php
/**
 * @author @ct-jensschulze <jens.schulze@commercetools.de>
 * @created: 02.02.15, 11:44
 */

namespace Sphere\Core\Request;

use Sphere\Core\Client\HttpRequest;
use Sphere\Core\Client\HttpMethod;
use Sphere\Core\Model\Common\Collection;
use Sphere\Core\Model\Common\Context;
use Sphere\Core\Model\Common\JsonDeserializeInterface;
use Sphere\Core\Model\Common\JsonObject;

/**
 * @package Sphere\Core\Request
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
