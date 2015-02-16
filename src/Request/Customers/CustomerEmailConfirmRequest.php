<?php
/**
 * @author @ct-jensschulze <jens.schulze@commercetools.de>
 * @created: 12.02.15, 14:18
 */

namespace Sphere\Core\Request\Customers;

use Sphere\Core\Client\HttpMethod;
use Sphere\Core\Client\JsonRequest;
use Sphere\Core\Request\AbstractUpdateRequest;
use Sphere\Core\Response\SingleResourceResponse;

/**
 * Class CustomerEmailConfirmRequest
 * @package Sphere\Core\Request\Customers
 * @method static CustomerEmailConfirmRequest of(string $id, int $version, string $tokenValue)
 */
class CustomerEmailConfirmRequest extends AbstractUpdateRequest
{
    const ID = 'id';
    const TOKEN_VALUE = 'tokenValue';

    /**
     * @var string
     */
    protected $tokenValue;
    /**
     * @param string $id
     * @param string $version
     * @param string $tokenValue
     */
    public function __construct($id, $version, $tokenValue)
    {
        parent::__construct(CustomersEndpoint::endpoint(), $id, $version);
        $this->setId($id);
        $this->setVersion($version);
        $this->tokenValue = $tokenValue;
    }

    /**
     * @return string
     * @internal
     */
    protected function getPath()
    {
        return (string)$this->getEndpoint() . '/email/confirm';
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
        ];
        return new JsonRequest(HttpMethod::POST, $this->getPath(), $payload);
    }

    /**
     * @param $response
     * @return SingleResourceResponse
     * @internal
     */
    public function buildResponse($response)
    {
        return new SingleResourceResponse($response, $this);
    }
}
