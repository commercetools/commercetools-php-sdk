<?php
/**
 * @author @jayS-de <jens.schulze@commercetools.de>
 * @created: 12.02.15, 10:42
 */

namespace Commercetools\Core\Request\Customers;

use Commercetools\Core\Client\HttpMethod;
use Commercetools\Core\Client\JsonRequest;
use Commercetools\Core\Model\Common\Context;
use Commercetools\Core\Request\AbstractApiRequest;
use Commercetools\Core\Model\Customer\Customer;
use Commercetools\Core\Response\ApiResponseInterface;
use Commercetools\Core\Response\ResourceResponse;
use Psr\Http\Message\ResponseInterface;
use Commercetools\Core\Model\MapperInterface;

/**
 * @package Commercetools\Core\Request\Customers
 * @link https://dev.commercetools.com/http-api-projects-customers.html#customers-password-reset
 * @method Customer mapResponse(ApiResponseInterface $response)
 * @method Customer mapFromResponse(ApiResponseInterface $response, MapperInterface $mapper = null)
 */
class CustomerPasswordResetRequest extends AbstractApiRequest
{
    const TOKEN_VALUE = 'tokenValue';
    const NEW_PASSWORD = 'newPassword';

    protected $resultClass = '\Commercetools\Core\Model\Customer\Customer';

    /**
     * @var string
     */
    protected $tokenValue;

    /**
     * @var string
     */
    protected $newPassword;

    /**
     * @param string $id
     * @param int $version
     * @param string $tokenValue
     * @param string $newPassword
     * @param Context $context
     */
    public function __construct($tokenValue, $newPassword, Context $context = null)
    {
        parent::__construct(CustomersEndpoint::endpoint(), $context);
        $this->tokenValue = $tokenValue;
        $this->newPassword = $newPassword;
    }

    /**
     * @param string $tokenValue
     * @param string $newPassword
     * @param Context $context
     * @return static
     */
    public static function ofTokenAndPassword(
        $tokenValue,
        $newPassword,
        Context $context = null
    ) {
        return new static($tokenValue, $newPassword, $context);
    }

    /**
     * @return string
     * @internal
     */
    protected function getPath()
    {
        return (string)$this->getEndpoint() . '/password/reset' . $this->getParamString();
    }

    /**
     * @return JsonRequest
     * @internal
     */
    public function httpRequest()
    {
        $payload = [
            static::TOKEN_VALUE => $this->tokenValue,
            static::NEW_PASSWORD => $this->newPassword
        ];
        return new JsonRequest(HttpMethod::POST, $this->getPath(), $payload);
    }

    public function buildResponse(ResponseInterface $response)
    {
        return new ResourceResponse($response, $this, $this->getContext());
    }
}
