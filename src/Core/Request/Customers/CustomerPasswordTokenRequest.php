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
 * phpcs:disable
 * @link https://docs.commercetools.com/http-api-projects-customers.html#create-a-token-for-resetting-the-customers-password
 * phpcs:enable
 * @method CustomerToken mapResponse(ApiResponseInterface $response)
 * @method CustomerToken mapFromResponse(ApiResponseInterface $response, MapperInterface $mapper = null)
 */
class CustomerPasswordTokenRequest extends AbstractApiRequest
{
    const EMAIL = 'email';
    const TTL_MINUTES = 'ttlMinutes';

    protected $resultClass = CustomerToken::class;

    /**
     * @var string
     */
    protected $email;

    /**
     * @var int
     */
    protected $ttlMinutes;

    /**
     * @param int $ttlMinutes
     * @return CustomerPasswordTokenRequest
     */
    public function setTtlMinutes($ttlMinutes)
    {
        $this->ttlMinutes = $ttlMinutes;

        return $this;
    }

    /**
     * @param string $email
     * @param Context|null $context
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
     * @param string $email
     * @param int $ttlMinutes
     * @param Context $context
     * @return static
     */
    public static function ofEmailAndTtlMinutes($email, $ttlMinutes, Context $context = null)
    {
        return (new static($email, $context))->setTtlMinutes($ttlMinutes);
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

        if (!is_null($this->ttlMinutes)) {
            $payload[static::TTL_MINUTES] = $this->ttlMinutes;
        }

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
