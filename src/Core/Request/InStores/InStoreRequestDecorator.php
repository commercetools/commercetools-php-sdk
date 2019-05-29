<?php
/**
 *
 */

namespace Commercetools\Core\Request\InStores;

use Commercetools\Core\Client;
use Commercetools\Core\Error\InvalidArgumentException;
use Commercetools\Core\Model\Common\Context;
use Commercetools\Core\Model\MapperInterface;
use Commercetools\Core\Request\ClientRequestInterface;
use Commercetools\Core\Response\ApiResponseInterface;
use Psr\Http\Message\RequestInterface;
use Psr\Http\Message\ResponseInterface;

class InStoreRequestDecorator implements ClientRequestInterface
{

    private $request;
    private $endpoint;

    /**
     * InStoreDecorator constructor.
     * @param string $storeKey
     * @param ClientRequestInterface $request
     */
    public function __construct($storeKey, ClientRequestInterface $request)
    {
        if (!InStoreRequests::of()->can(get_class($request))) {
            throw new InvalidArgumentException('In-store request is not available in: ' . get_class($request));
        }

        $this->request = $request;
        $this->endpoint = InStoreEndpoint::endpoint($storeKey);
    }

    public function getIdentifier()
    {
        return $this->request->getIdentifier();
    }

    public function setIdentifier($identifier)
    {
        return $this->request->setIdentifier($identifier);
    }

    public function httpRequest()
    {
        return $this->decorateUri($this->request->httpRequest());
    }

    private function decorateUri(RequestInterface $request)
    {
        return $request->withUri($request->getUri()->withPath($this->endpoint . $request->getUri()->getPath()));
    }

    public function buildResponse(ResponseInterface $response)
    {
        return $this->request->buildResponse($response);
    }

    public function mapResult(array $result, Context $context = null)
    {
        return $this->request->mapResult($result, $context);
    }

    public function mapResponse(ApiResponseInterface $response)
    {
        return $this->request->mapResponse($response);
    }

    public function map(array $data, Context $context = null, MapperInterface $mapper = null)
    {
        return $this->request->map($data, $context, $mapper);
    }

    public function mapFromResponse(ApiResponseInterface $response, MapperInterface $mapper = null)
    {
        return $this->request->mapFromResponse($response, $mapper);
    }

    /**
     * @param Client $client
     * @param array $headers
     * @return ApiResponseInterface
     */
    public function executeWithClient(Client $client, array $headers = null)
    {
        return $client->execute($this, $headers);
    }

    /**
     * @param string $storeKey
     * @param ClientRequestInterface $request
     * @return InStoreRequestDecorator
     */
    public static function ofStoreKeyAndRequest($storeKey, ClientRequestInterface $request)
    {
        return new static($storeKey, $request);
    }
}
