<?php
/**
 * @author @ct-jensschulze <jens.schulze@commercetools.de>
 */

namespace Sphere\Core\Request\Project;

use Psr\Http\Message\ResponseInterface;
use Sphere\Core\Client\HttpMethod;
use Sphere\Core\Client\HttpRequest;
use Sphere\Core\Client\JsonEndpoint;
use Sphere\Core\Model\Common\Context;
use Sphere\Core\Request\AbstractApiRequest;
use Sphere\Core\Response\SingleResourceResponse;
use Sphere\Core\Model\Project\Project;
use Sphere\Core\Response\ApiResponseInterface;

/**
 * @package Sphere\Core\Request\Project
 *  *
 * @method Project mapResponse(ApiResponseInterface $response)
 */
class ProjectGetRequest extends AbstractApiRequest
{
    protected $resultClass = '\Sphere\Core\Model\Project\Project';

    public function __construct(Context $context = null)
    {
        parent::__construct(new JsonEndpoint(''), $context);
    }
    /**
     * @param ResponseInterface $response
     * @return SingleResourceResponse
     * @internal
     */
    public function buildResponse(ResponseInterface $response)
    {
        return new SingleResourceResponse($response, $this, $this->getContext());
    }

    /**
     * @return HttpRequest
     * @internal
     */
    public function httpRequest()
    {
        return new HttpRequest(HttpMethod::GET, $this->getPath());
    }

    /**
     * @param Context $context
     * @return static
     */
    public static function of(Context $context = null)
    {
        return new static($context);
    }
}
