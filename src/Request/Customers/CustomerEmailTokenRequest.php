<?php
/**
 * @author @ct-jensschulze <jens.schulze@commercetools.de>
 * @created: 12.02.15, 12:34
 */

namespace Sphere\Core\Request\Customers;

use GuzzleHttp\Message\ResponseInterface;
use Sphere\Core\Client\HttpMethod;
use Sphere\Core\Client\JsonRequest;
use Sphere\Core\Request\AbstractUpdateRequest;
use Sphere\Core\Response\SingleResourceResponse;

/**
 * Class CustomerEmailTokenRequest
 * @package Sphere\Core\Request\Customers
 * @method static CustomerEmailTokenRequest of(string $id, int $version, int $ttlMinutes)
 */
class CustomerEmailTokenRequest extends AbstractUpdateRequest
{
    const ID = 'id';
    const TTL_MINUTES = 'ttlMinutes';

    /**
     * @var int
     */
    protected $ttlMinutes;
    /**
     * @param string $id
     * @param string $version
     * @param int $ttlMinutes
     */
    public function __construct($id, $version, $ttlMinutes)
    {
        parent::__construct(CustomersEndpoint::endpoint(), $id, $version);
        $this->setId($id);
        $this->setVersion($version);
        $this->ttlMinutes = $ttlMinutes;
    }

    /**
     * @return string
     * @internal
     */
    protected function getPath()
    {
        return (string)$this->getEndpoint() . '/email-token';
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
            static::TTL_MINUTES => $this->ttlMinutes,
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
        return new SingleResourceResponse($response, $this, $this->getContext());
    }
}
