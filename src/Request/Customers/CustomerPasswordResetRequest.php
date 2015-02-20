<?php
/**
 * @author @ct-jensschulze <jens.schulze@commercetools.de>
 * @created: 12.02.15, 10:42
 */

namespace Sphere\Core\Request\Customers;


use GuzzleHttp\Message\ResponseInterface;
use Sphere\Core\Client\HttpMethod;
use Sphere\Core\Client\JsonEndpoint;
use Sphere\Core\Client\JsonRequest;
use Sphere\Core\Request\AbstractUpdateRequest;
use Sphere\Core\Response\SingleResourceResponse;

/**
 * Class CustomerPasswordResetRequest
 * @package Sphere\Core\Request\Customers
 * @method static CustomerPasswordResetRequest of(string $id, string $version, string $tokenValue, string $newPassword)
 */
class CustomerPasswordResetRequest extends AbstractUpdateRequest
{
    const ID = 'id';
    const VERSION = 'version';
    const TOKEN_VALUE = 'tokenValue';
    const NEW_PASSWORD = 'newPassword';

    protected $tokenValue;
    protected $newPassword;

    /**
     * @param string $id
     * @param string $version
     * @param string $tokenValue
     * @param string $newPassword
     */
    public function __construct($id, $version, $tokenValue, $newPassword)
    {
        parent::__construct(CustomersEndpoint::endpoint(), $id, $version);
        $this->setId($id);
        $this->setVersion($version);
        $this->tokenValue = $tokenValue;
        $this->newPassword = $newPassword;
    }

    /**
     * @return string
     * @internal
     */
    protected function getPath()
    {
        return (string)$this->getEndpoint() . '/password/reset';
    }

    /**
     * @return JsonRequest
     * @internal
     */
    public function httpRequest()
    {
        $payload = [
            static::ID => $this->getId(),
            static::VERSION => $this->getVersion(),
            static::TOKEN_VALUE => $this->tokenValue,
            static::NEW_PASSWORD => $this->newPassword
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
