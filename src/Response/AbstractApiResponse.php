<?php
/**
 * @author @ct-jensschulze <jens.schulze@commercetools.de>
 * @created: 26.01.15, 14:44
 */

namespace Sphere\Core\Response;


use GuzzleHttp\Message\ResponseInterface;
use GuzzleHttp\Ring\Future\FutureInterface;
use React\Promise\PromiseInterface;
use Sphere\Core\Error\Message;
use Sphere\Core\Model\Common\Context;
use Sphere\Core\Model\Common\ContextAwareInterface;
use Sphere\Core\Model\Common\ContextTrait;
use Sphere\Core\Request\ClientRequestInterface;

/**
 * Class AbstractApiResponse
 * @package Sphere\Core\Response
 */
abstract class AbstractApiResponse implements ApiResponseInterface, ContextAwareInterface
{
    use ContextTrait;

    /**
     * @var ResponseInterface
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
            return $this->getRequest()->mapResult($this->toArray(), $this->getContext());
        }

        return null;
    }

    /**
     * @return array
     */
    public function toArray()
    {
        if (is_null($this->jsonData)) {
            $this->jsonData = (array)$this->response->json();
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
        $statusCode = $this->response->getStatusCode();

        return (!in_array($statusCode, [200, 201]));
    }

    /**
     * @return ResponseInterface|FutureInterface
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
        if (!$this->getResponse() instanceof FutureInterface) {
            throw new \BadMethodCallException(Message::FUTURE_BAD_METHOD_CALL);
        }
        return $this->getResponse()->wait();
    }

    /**
     * Cancels the future, if possible.
     */
    public function cancel()
    {
        if (!$this->getResponse() instanceof FutureInterface) {
            throw new \BadMethodCallException(Message::FUTURE_BAD_METHOD_CALL);
        }
        $this->getResponse()->cancel();
    }

    /**
     * @param callable $onFulfilled
     * @param callable $onRejected
     * @param callable $onProgress
     * @return PromiseInterface
     */
    public function then(callable $onFulfilled = null, callable $onRejected = null, callable $onProgress = null)
    {
        if (!$this->getResponse() instanceof FutureInterface) {
            throw new \BadMethodCallException(Message::FUTURE_BAD_METHOD_CALL);
        }
        return $this->getResponse()->then($onFulfilled, $onRejected, $onProgress);
    }

    /**
     * @return PromiseInterface
     */
    public function promise()
    {
        if (!$this->getResponse() instanceof FutureInterface) {
            throw new \BadMethodCallException(Message::FUTURE_BAD_METHOD_CALL);
        }
        return $this->getResponse()->promise();
    }
}
