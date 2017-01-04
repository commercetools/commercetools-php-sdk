<?php
/**
 * @author @jayS-de <jens.schulze@commercetools.de>
 * @created: 12.02.15, 12:34
 */

namespace Commercetools\Core\Request\Customers;

use Commercetools\Core\Client\HttpMethod;
use Commercetools\Core\Client\JsonRequest;
use Commercetools\Core\Model\Common\Context;
use Commercetools\Core\Request\AbstractUpdateRequest;
use Commercetools\Core\Model\Customer\CustomerToken;
use Commercetools\Core\Response\ApiResponseInterface;
use Commercetools\Core\Model\MapperInterface;

/**
 * @package Commercetools\Core\Request\Customers
 * @link https://dev.commercetools.com/http-api-projects-customers.html#create-a-token-for-verifying-the-customers-email
 * @method CustomerToken mapResponse(ApiResponseInterface $response)
 * @method CustomerToken mapFromResponse(ApiResponseInterface $response, MapperInterface $mapper = null)
 */
class CustomerEmailTokenRequest extends AbstractUpdateRequest
{
    const ID = 'id';
    const TTL_MINUTES = 'ttlMinutes';

    protected $resultClass = CustomerToken::class;

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
        return (string)$this->getEndpoint() . '/email-token' . $this->getParamString();
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
