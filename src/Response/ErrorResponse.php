<?php
/**
 * @author @jayS-de <jens.schulze@commercetools.de>
 */

namespace Commercetools\Core\Response;

use Commercetools\Core\Model\Common\Context;
use Commercetools\Core\Request\ClientRequestInterface;
use Psr\Http\Message\ResponseInterface;

class ErrorResponse extends AbstractApiResponse
{
    /**
     * @var \Exception
     */
    private $exception;

    /**
     * ErrorResponse constructor.
     * @param ResponseInterface $response
     * @param ClientRequestInterface $request
     * @param \Exception $exception
     * @param Context $context
     */
    public function __construct(
        \Exception $exception,
        ClientRequestInterface $request,
        ResponseInterface $response = null,
        Context $context = null
    ) {
        parent::__construct($response, $request, $context);
        $this->exception = $exception;
    }

    public function isError()
    {
        return true;
    }

    /**
     * @return array
     */
    public function getErrors()
    {
        $result = $this->toArray();

        return isset($result['errors']) ? $result['errors']: [];
    }

    public function getMessage()
    {
        $result = $this->toArray();

        return isset($result['message']) ? $result['message']: '';
    }
}
