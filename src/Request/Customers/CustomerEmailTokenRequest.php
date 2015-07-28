<?php
/**
 * @author @ct-jensschulze <jens.schulze@commercetools.de>
 * @created: 12.02.15, 12:34
 */

namespace Sphere\Core\Request\Customers;

use Sphere\Core\Client\HttpMethod;
use Sphere\Core\Client\JsonRequest;
use Sphere\Core\Model\Common\Context;
use Sphere\Core\Request\AbstractUpdateRequest;
use Sphere\Core\Model\Customer\CustomerToken;
use Sphere\Core\Response\ApiResponseInterface;

/**
 * @package Sphere\Core\Request\Customers
 * @apidoc http://dev.sphere.io/http-api-projects-customers.html#create-token-for-verifying-customers-email
 * @method CustomerToken mapResponse(ApiResponseInterface $response)
 */
class CustomerEmailTokenRequest extends AbstractUpdateRequest
{
    const ID = 'id';
    const TTL_MINUTES = 'ttlMinutes';

    protected $resultClass = '\Sphere\Core\Model\Customer\CustomerToken';

    /**
     * @var int
     */
    protected $ttlMinutes;

    /**
     * @param string $id
     * @param int $version
     * @param int $ttlMinutes
     * @param Context $context
     */
    public function __construct($id, $version, $ttlMinutes, Context $context = null)
    {
        parent::__construct(CustomersEndpoint::endpoint(), $id, $version, [], $context);
        $this->setId($id);
        $this->setVersion($version);
        $this->ttlMinutes = $ttlMinutes;
    }

    /**
     * @param string $id
     * @param int $version
     * @param int $ttlMinutes
     * @param Context $context
     * @return static
     */
    public static function ofIdVersionAndTtl($id, $version, $ttlMinutes, Context $context = null)
    {
        return new static($id, $version, $ttlMinutes, $context);
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
}
