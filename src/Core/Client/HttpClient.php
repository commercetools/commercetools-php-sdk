<?php

namespace Commercetools\Core\Client;

use Commercetools\Core\Model\Common\ContextAwareInterface;
use Commercetools\Core\Model\Common\ContextTrait;
use Commercetools\Core\Request\ClientRequestInterface;
use GuzzleHttp\Client;
use GuzzleHttp\Exception\GuzzleException;
use GuzzleHttp\Promise\PromiseInterface;
use Psr\Http\Message\ResponseInterface;

class HttpClient extends Client implements ContextAwareInterface
{
    use ContextTrait;

    /**
     * @param ClientRequestInterface $request
     * @param array|null $headers
     * @param array $options
     * @return mixed|ResponseInterface
     * @throws GuzzleException
     */
    public function execute(ClientRequestInterface $request, array $headers = null, array $options = [])
    {
        if ($request instanceof ContextAwareInterface) {
            $request->setContextIfNull($this->getContext());
        }
        $httpRequest = $request->httpRequest();
        if (is_array($headers)) {
            foreach ($headers as $headerName => $headerValues) {
                $httpRequest = $httpRequest
                    ->withAddedHeader($headerName, $headerValues)
                ;
            }
        }
        return parent::send($httpRequest, $options);
    }

    /**
     * @param ClientRequestInterface $request
     * @param array|null $headers
     * @param array $options
     * @return PromiseInterface
     */
    public function executeAsync(ClientRequestInterface $request, array $headers = null, array $options = [])
    {
        if ($request instanceof ContextAwareInterface) {
            $request->setContextIfNull($this->getContext());
        }
        $httpRequest = $request->httpRequest();
        if (is_array($headers)) {
            foreach ($headers as $headerName => $headerValues) {
                $httpRequest = $httpRequest
                    ->withAddedHeader($headerName, $headerValues)
                ;
            }
        }
        return parent::sendAsync($httpRequest, $options);
    }
}
