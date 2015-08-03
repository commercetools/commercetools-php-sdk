<?php
/**
 * @author @ct-jensschulze <jens.schulze@commercetools.de>
 * @created: 12.02.15, 14:18
 */

namespace Commercetools\Core\Request\Customers;

use Commercetools\Core\Client\HttpMethod;
use Commercetools\Core\Client\JsonRequest;
use Commercetools\Core\Model\Common\Context;
use Commercetools\Core\Request\AbstractUpdateRequest;
use Commercetools\Core\Response\ApiResponseInterface;
use Commercetools\Core\Model\Customer\Customer;

/**
 * @package Commercetools\Core\Request\Customers
 * @apidoc http://dev.sphere.io/http-api-projects-customers.html#verify-customers-email
 * @method Customer mapResponse(ApiResponseInterface $response)
 */
class CustomerEmailConfirmRequest extends AbstractUpdateRequest
{
    protected $resultClass = '\Commercetools\Core\Model\Customer\Customer';

    const ID = 'id';
    const TOKEN_VALUE = 'tokenValue';

    /**
     * @var string
     */
    protected $tokenValue;

    /**
     * @param string $id
     * @param int $version
     * @param string $tokenValue
     * @param Context $context
     */
    public function __construct($id, $version, $tokenValue, Context $context = null)
    {
        parent::__construct(CustomersEndpoint::endpoint(), $id, $version, [], $context);
        $this->setId($id);
        $this->setVersion($version);
        $this->tokenValue = $tokenValue;
    }

    /**
     * @param string $id
     * @param int $version
     * @param string $tokenValue
     * @param Context $context
     * @return static
     */
    public static function ofIdVersionAndToken($id, $version, $tokenValue, Context $context = null)
    {
        return new static($id, $version, $tokenValue, $context);
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
}
