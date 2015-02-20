<?php
/**
 * @author @ct-jensschulze <jens.schulze@commercetools.de>
 * @created: 11.02.15, 17:40
 */

namespace Sphere\Core\Request\Customers;


use GuzzleHttp\Message\ResponseInterface;
use Sphere\Core\Client\HttpMethod;
use Sphere\Core\Client\JsonRequest;
use Sphere\Core\Request\AbstractApiRequest;
use Sphere\Core\Response\SingleResourceResponse;

/**
 * Class CustomerPasswordTokenRequest
 * @package Sphere\Core\Request\Customers
 * @method static CustomerPasswordTokenRequest of(string $email)
 */
class CustomerPasswordTokenRequest extends AbstractApiRequest
{
    const EMAIL = 'email';
    /**
     * @var string
     */
    protected $email;

    /**
     * @param string $email
     */
    public function __construct($email)
    {
        parent::__construct(CustomersEndpoint::endpoint());
        $this->email = $email;
    }

    /**
     * @return string
     * @internal
     */
    protected function getPath()
    {
        return (string)$this->getEndpoint() . '/password-token';
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
     * @return SingleResourceResponse
     * @internal
     */
    public function buildResponse(ResponseInterface $response)
    {
        return new SingleResourceResponse($response, $this);
    }
}
