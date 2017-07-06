<?php
/**
 * @author @jayS-de <jens.schulze@commercetools.de>
 * @created: 12.02.15, 10:35
 */

namespace Commercetools\Core\Request;

use Commercetools\Core\Client\JsonEndpoint;
use Psr\Http\Message\ResponseInterface;
use Commercetools\Core\Client\HttpMethod;
use Commercetools\Core\Client\HttpRequest;
use Commercetools\Core\Model\Common\Context;
use Commercetools\Core\Response\ResourceResponse;

abstract class AbstractByTokenGetRequest extends AbstractApiRequest
{
    const TOKEN = 'token';
    const TOKEN_NAME = 'token';

    protected $token;

    /**
     * @param string $token
     * @param Context $context
     */
    public function __construct(JsonEndpoint $endpoint, $token, Context $context = null)
    {
        parent::__construct($endpoint, $context);
        $this->setToken($token);
    }

    /**
     * @return string
     */
    public function getToken()
    {
        return $this->token;
    }

    /**
     * @param string $token
     * @return $this
     */
    public function setToken($token)
    {
        $this->token = $token;

        return $this;
    }

    /**
     * @return string
     * @internal
     */
    protected function getPath()
    {
        return (string)$this->getEndpoint() . '/' . static::TOKEN_NAME . '=' . $this->getToken() .
            $this->getParamString();
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
     * @param ResponseInterface $response
     * @return ResourceResponse
     * @internal
     */
    public function buildResponse(ResponseInterface $response)
    {
        return new ResourceResponse($response, $this, $this->getContext());
    }
}
