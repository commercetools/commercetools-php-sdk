<?php
/**
 * @author @ct-jensschulze <jens.schulze@commercetools.de>
 * @created: 26.01.15, 14:44
 */

namespace Commercetools\Core\Response;


use Psr\Http\Message\ResponseInterface;
use Commercetools\Core\Client\Adapter\AdapterPromiseInterface;
use Commercetools\Core\Error\Message;
use Commercetools\Core\Model\Common\Context;
use Commercetools\Core\Model\Common\ContextAwareInterface;
use Commercetools\Core\Model\Common\ContextTrait;
use Commercetools\Core\Request\ClientRequestInterface;

/**
 * @package Commercetools\Core\Response
 */
abstract class AbstractApiResponse implements ApiResponseInterface, ContextAwareInterface
{
    use ContextTrait;

    /**
     * @var ResponseInterface|AdapterPromiseInterface
     */
    protected $response;

    /**
     * @var ClientRequestInterface
     */
    protected $request;

    /**
     * @var array
     */
    protected $jsonData;

    /**
     * @var string
     */
    protected $responseBody;

    /**
     * @param ResponseInterface $response
     * @param ClientRequestInterface $request
     * @param Context $context
     */
    public function __construct(ResponseInterface $response, ClientRequestInterface $request, Context $context = null)
    {
        $this->setContext($context);
        $this->response = $response;
        $this->request = $request;
    }

    /**
     * @return mixed|null
     */
    public function toObject()
    {
        if (!$this->isError()) {
            return $this->getRequest()->mapResponse($this);
        }

        return null;
    }

    /**
     * @return array
     */
    public function toArray()
    {
        if (is_null($this->jsonData)) {
            $this->jsonData = json_decode($this->getBody(), true);
        }
        return $this->jsonData;
    }

    /**
     * @return string
     */
    public function getBody()
    {
        if (is_null($this->responseBody)) {
            $this->responseBody = (string)$this->response->getBody();
        }
        return $this->responseBody;
    }

    /**
     * @return bool
     */
    public function isError()
    {
        $statusCode = $this->getStatusCode();

        return (!in_array($statusCode, [200, 201]));
    }

    public function getStatusCode()
    {
        return $this->getResponse()->getStatusCode();
    }

    /**
     * @param string $header
     * @return array
     */
    public function getHeader($header)
    {
        return $this->getResponse()->getHeader($header);
    }

    /**
     * @return array
     */
    public function getHeaders()
    {
        return $this->getResponse()->getHeaders();
    }

    /**
     * @return ResponseInterface|AdapterPromiseInterface
     */
    public function getResponse()
    {
        return $this->response;
    }

    /**
     * @return ClientRequestInterface
     */
    public function getRequest()
    {
        return $this->request;
    }

    /**
     * Returns the result of the future either from cache or by blocking until
     * it is complete.
     *
     * This method must block until the future has a result or is cancelled.
     * Throwing an exception in the wait() method will mark the future as
     * realized and will throw the exception each time wait() is called.
     * Throwing an instance of GuzzleHttp\Ring\CancelledException will mark
     * the future as realized, will not throw immediately, but will throw the
     * exception if the future's wait() method is called again.
     *
     * @return mixed
     */
    public function wait()
    {
        if (!$this->getResponse() instanceof AdapterPromiseInterface) {
            throw new \BadMethodCallException(Message::FUTURE_BAD_METHOD_CALL);
        }

        return $this->getResponse()->wait();
    }

    /**
     * @param callable $onFulfilled
     * @param callable $onRejected
     * @return ApiResponseInterface
     */
    public function then(callable $onFulfilled = null, callable $onRejected = null)
    {
        if (!$this->getResponse() instanceof AdapterPromiseInterface) {
            throw new \BadMethodCallException(Message::FUTURE_BAD_METHOD_CALL);
        }
        $this->getResponse()->then($onFulfilled, $onRejected);

        return $this;
    }
}
