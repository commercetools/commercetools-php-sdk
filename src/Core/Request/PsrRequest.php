<?php
/**
 * @author @jayS-de <jens.schulze@commercetools.de>
 */

namespace Commercetools\Core\Request;

use Commercetools\Core\Client\JsonEndpoint;
use Commercetools\Core\Model\Common\Context;
use Commercetools\Core\Response\ResourceResponse;
use Psr\Http\Message\RequestInterface;
use Psr\Http\Message\ResponseInterface;
use Commercetools\Core\Model\Common\JsonObject;
use Commercetools\Core\Response\ApiResponseInterface;
use Commercetools\Core\Model\MapperInterface;

/**
 * @package Commercetools\Core\Request
 *
 * @method JsonObject mapResponse(ApiResponseInterface $response)
 * @method JsonObject mapFromResponse(ApiResponseInterface $response, MapperInterface $mapper = null)
 */
class PsrRequest extends AbstractApiRequest
{
    /**
     * @var RequestInterface
     */
    private $request;

    public function __construct(RequestInterface $request, Context $context = null)
    {
        $this->request = $request;
        parent::__construct(new JsonEndpoint(''), $context);
    }

    public static function ofRequest(RequestInterface $request, Context $context = null)
    {
        return new static($request, $context);
    }

    public function buildResponse(ResponseInterface $response)
    {
        return new ResourceResponse($response, $this, $this->getContext());
    }

    public function httpRequest()
    {
        return $this->request;
    }
}
