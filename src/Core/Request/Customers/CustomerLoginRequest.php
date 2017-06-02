<?php
/**
 * @author @jayS-de <jens.schulze@commercetools.de>
 * @created: 11.02.15, 15:53
 */

namespace Commercetools\Core\Request\Customers;

use Psr\Http\Message\ResponseInterface;
use Commercetools\Core\Client\HttpMethod;
use Commercetools\Core\Client\JsonRequest;
use Commercetools\Core\Model\Common\Context;
use Commercetools\Core\Request\AbstractApiRequest;
use Commercetools\Core\Response\ResourceResponse;
use Commercetools\Core\Model\Customer\CustomerSigninResult;
use Commercetools\Core\Response\ApiResponseInterface;
use Commercetools\Core\Model\MapperInterface;

/**
 * @package Commercetools\Core\Request\Customers
 * @link https://dev.commercetools.com/http-api-projects-customers.html#authenticate-customer-sign-in
 * @method CustomerSigninResult mapResponse(ApiResponseInterface $response)
 * @method CustomerSigninResult mapFromResponse(ApiResponseInterface $response, MapperInterface $mapper = null)
 */
class CustomerLoginRequest extends AbstractApiRequest
{
    const EMAIL = 'email';
    const PASSWORD = 'password';
    const ANONYMOUS_CART_ID = 'anonymousCartId';
    const ANONYMOUS_CART_SIGN_IN_MODE = 'anonymousCartSignInMode';
    const SIGN_IN_MODE_MERGE = 'MergeWithExistingCustomerCart';
    const SIGN_IN_MODE_NEW = 'UseAsNewActiveCustomerCart';

    /**
     * @var string
     */
    protected $email;

    /**
     * @var string
     */
    protected $password;

    /**
     * @var string
     */
    protected $anonymousCartId;

    protected $anonymousCartSignInMode;

    protected $resultClass = CustomerSigninResult::class;

    /**
     * @param string $email
     * @param string $password
     * @param string $anonymousCartId
     * @param Context $context
     */
    public function __construct($email, $password, $anonymousCartId = null, Context $context = null)
    {
        parent::__construct(LoginEndpoint::endpoint(), $context);
        $this->email = $email;
        $this->password = $password;
        $this->anonymousCartId = $anonymousCartId;
    }

    /**
     * @return string
     */
    public function getEmail()
    {
        return $this->email;
    }

    /**
     * @param string $email
     * @return $this
     */
    public function setEmail($email)
    {
        $this->email = $email;

        return $this;
    }

    /**
     * @return string
     */
    public function getPassword()
    {
        return $this->password;
    }

    /**
     * @param string $password
     * @return $this
     */
    public function setPassword($password)
    {
        $this->password = $password;

        return $this;
    }

    /**
     * @return string
     */
    public function getAnonymousCartId()
    {
        return $this->anonymousCartId;
    }

    /**
     * @param string $anonymousCartId
     * @return $this
     */
    public function setAnonymousCartId($anonymousCartId)
    {
        $this->anonymousCartId = $anonymousCartId;

        return $this;
    }

    /**
     * @return mixed
     */
    public function getAnonymousCartSignInMode()
    {
        return $this->anonymousCartSignInMode;
    }

    /**
     * @param mixed $anonymousCartSignInMode
     * @return $this
     */
    public function setAnonymousCartSignInMode($anonymousCartSignInMode)
    {
        $this->anonymousCartSignInMode = $anonymousCartSignInMode;

        return $this;
    }

    /**
     * @param string $email
     * @param string $password
     * @param string $anonymousCartId
     * @param Context $context
     * @return static
     */
    public static function ofEmailAndPassword($email, $password, $anonymousCartId = null, Context $context = null)
    {
        return new static($email, $password, $anonymousCartId, $context);
    }

    /**
     * @return JsonRequest
     * @internal
     */
    public function httpRequest()
    {
        $payload = [
            static::EMAIL => $this->email,
            static::PASSWORD => $this->password,
        ];
        if (!is_null($this->anonymousCartId)) {
            $payload[static::ANONYMOUS_CART_ID] = $this->anonymousCartId;
        }
        if (!is_null($this->anonymousCartSignInMode)) {
            $payload[static::ANONYMOUS_CART_SIGN_IN_MODE] = $this->anonymousCartSignInMode;
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
