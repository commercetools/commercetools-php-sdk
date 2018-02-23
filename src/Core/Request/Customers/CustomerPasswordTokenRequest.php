<?php
/**
 * @author @jenschude <jens.schulze@commercetools.de>
 * @created: 11.02.15, 17:40
 */

namespace Commercetools\Core\Request\Customers;

use Psr\Http\Message\ResponseInterface;
use Commercetools\Core\Client\HttpMethod;
use Commercetools\Core\Client\JsonRequest;
use Commercetools\Core\Model\Common\Context;
use Commercetools\Core\Request\AbstractApiRequest;
use Commercetools\Core\Response\ResourceResponse;
use Commercetools\Core\Model\Customer\CustomerToken;
use Commercetools\Core\Response\ApiResponseInterface;
use Commercetools\Core\Model\MapperInterface;

/**
 * @package Commercetools\Core\Request\Customers
 * @codingStandardsIgnoreStart
 * @link https://docs.commercetools.com/http-api-projects-customers.html#create-a-token-for-resetting-the-customers-password
 * @codingStandardsIgnoreEnd
 * @method CustomerToken mapResponse(ApiResponseInterface $response)
 * @method CustomerToken mapFromResponse(ApiResponseInterface $response, MapperInterface $mapper = null)
 */
class CustomerPasswordTokenRequest extends AbstractApiRequest
{
    const EMAIL = 'email';

    protected $resultClass = CustomerToken::class;

    /**
     * @var string
     */
    protected $email;

    /**
     * @param string $email
     * @param Context $context
     */
    public function __construct($email, Context $context = null)
    {
        parent::__construct(CustomersEndpoint::endpoint(), $context);
        $this->email = $email;
    }

    /**
     * @param string $email
     * @param Context $context
     * @return static
     */
    public static function ofEmail(
        $email,
        Context $context = null
    ) {
        return new static($email, $context);
    }

    /**
     * @return string
     * @internal
     */
    protected function getPath()
    {
        return (string)$this->getEndpoint() . '/password-token' . $this->getParamString();
    }

    /**
     * @return JsonRequest
     * @internal
     */
    public function httpRequest()
    {
        $payload = [
            static::EMAIL => $this->email
        ];
        return new JsonRequest(HttpMethod::POST, $this->getPath(), $payload);
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
