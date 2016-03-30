<?php
/**
 * @author @jayS-de <jens.schulze@commercetools.de>
 */

namespace Commercetools\Core\Response;

use Commercetools\Core\Error\ErrorContainer;
use Commercetools\Core\Model\Common\Context;
use Commercetools\Core\Request\ClientRequestInterface;
use Psr\Http\Message\ResponseInterface;

class ErrorResponse extends AbstractApiResponse
{
    /**
     * @var \Exception
     */
    private $exception;

    private $message;
    private $statusCode;

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

    public function getMessage()
    {
        if (is_null($this->message)) {
            $this->message = $this->getResponseField('message');
        }
        return $this->message;
    }
}
