<?php
/**
 * @author @jenschude <jens.schulze@commercetools.de>
 */

namespace Commercetools\Core\Request\Project;

use Psr\Http\Message\ResponseInterface;
use Commercetools\Core\Client\HttpMethod;
use Commercetools\Core\Client\HttpRequest;
use Commercetools\Core\Client\JsonEndpoint;
use Commercetools\Core\Model\Common\Context;
use Commercetools\Core\Request\AbstractApiRequest;
use Commercetools\Core\Response\ResourceResponse;
use Commercetools\Core\Model\Project\Project;
use Commercetools\Core\Response\ApiResponseInterface;
use Commercetools\Core\Model\MapperInterface;

/**
 * @package Commercetools\Core\Request\Project
 * @link https://docs.commercetools.com/http-api-projects-project.html#get-project
 * @method Project mapResponse(ApiResponseInterface $response)
 * @method Project mapFromResponse(ApiResponseInterface $response, MapperInterface $mapper = null)
 */
class ProjectGetRequest extends AbstractApiRequest
{
    protected $resultClass = Project::class;

    public function __construct(Context $context = null)
    {
        parent::__construct(new JsonEndpoint(''), $context);
    }
    /**
     * @param ResponseInterface $response
     * @return ResourceResponse
     * @internal
     */
    public function buildResponse(ResponseInterface $response)
    {
        return new ResourceResponse($response, $this, $this->getContext());
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
