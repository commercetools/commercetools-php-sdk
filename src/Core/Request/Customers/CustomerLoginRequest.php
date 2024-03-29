<?php
/**
 * @author @jenschude <jens.schulze@commercetools.de>
 * @created: 11.02.15, 15:53
 */

namespace Commercetools\Core\Request\Customers;

use Commercetools\Core\Model\Cart\Cart;
use Commercetools\Core\Model\Cart\CartReference;
use Commercetools\Core\Model\Common\ResourceIdentifier;
use Commercetools\Core\Model\Customer\CustomerDraft;
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
 * @link https://docs.commercetools.com/http-api-projects-customers.html#authenticate-customer-sign-in
 * @method CustomerSigninResult mapResponse(ApiResponseInterface $response)
 * @method CustomerSigninResult mapFromResponse(ApiResponseInterface $response, MapperInterface $mapper = null)
 */
class CustomerLoginRequest extends AbstractApiRequest
{
    const EMAIL = 'email';
    const PASSWORD = 'password';
    const ANONYMOUS_CART = 'anonymousCart';
    const ANONYMOUS_CART_ID = 'anonymousCartId';
    const ANONYMOUS_CART_SIGN_IN_MODE = 'anonymousCartSignInMode';
    const SIGN_IN_MODE_MERGE = 'MergeWithExistingCustomerCart';
    const SIGN_IN_MODE_NEW = 'UseAsNewActiveCustomerCart';
    const UPDATE_PRODUCT_DATA = 'updateProductData';

    /**
     * @var string
     */
    protected $email;

    /**
     * @var string
     */
    protected $password;

    /**
     * @var CartReference
     */
    protected $anonymousCart;

    /**
     * @deprecated use $anonymousCart instead
     * @var string
     */
    protected $anonymousCartId;

    protected $anonymousCartSignInMode;

    /**
     * @var bool
     */
    protected $updateProductData;

    protected $resultClass = CustomerSigninResult::class;

    /**
     * @param string $email
     * @param string $password
     * @param CartReference|string|null $anonymousCart
     * @param Context $context
     */
    public function __construct($email, $password, $anonymousCart = null, Context $context = null)
    {
        parent::__construct(LoginEndpoint::endpoint(), $context);
        $this->email = $email;
        $this->password = $password;
        if ($anonymousCart instanceof CartReference) {
            $this->anonymousCart = $anonymousCart;
        } elseif ($anonymousCart !== null) {
            $this->anonymousCart = CartReference::ofId($anonymousCart);
        }
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
     * @deprecated use $getAnonymousCart instead
     * @return string
     */
    public function getAnonymousCartId()
    {
        if ($this->anonymousCart == null) {
            return null;
        }
        return $this->anonymousCart->getId();
    }

    /**
     * @deprecated use $setAnonymousCart instead
     * @param string $anonymousCartId
     * @return $this
     */
    public function setAnonymousCartId($anonymousCartId)
    {
        $this->anonymousCart = CartReference::ofId($anonymousCartId);

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
     * @return bool
     */
    public function getUpdateProductData()
    {
        return $this->updateProductData;
    }

    /**
     * @param bool $updateProductData
     * @return $this
     */
    public function setUpdateProductData($updateProductData)
    {
        $this->updateProductData = $updateProductData;
        return $this;
    }

    /**
     * @return CartReference
     */
    public function getAnonymousCart()
    {
        return $this->anonymousCart;
    }

    /**
     * @param CartReference $anonymousCart
     * @return $this
     */
    public function setAnonymousCart($anonymousCart)
    {
        $this->anonymousCart = $anonymousCart;

        return $this;
    }

    /**
     * @param string $email
     * @param string $password
     * @param CartReference|string $anonymousCart
     * @param Context $context
     * @return static
     */
    public static function ofEmailAndPassword($email, $password, $anonymousCart = null, Context $context = null)
    {
        return new static($email, $password, $anonymousCart, $context);
    }

    /**
     * @param string $email
     * @param string $password
     * @param bool $updateProductData
     * @param CartReference|string $anonymousCart
     * @param Context $context
     * @return static
     */
    public static function ofEmailPasswordAndUpdateProductData(
        $email,
        $password,
        $updateProductData,
        $anonymousCart = null,
        Context $context = null
    ) {
        $request = new static($email, $password, $anonymousCart, $context);
        $request->setUpdateProductData($updateProductData);

        return $request;
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
        if (!is_null($this->anonymousCart)) {
            $payload[static::ANONYMOUS_CART] = $this->anonymousCart;
        }
        if (!is_null($this->anonymousCartSignInMode)) {
            $payload[static::ANONYMOUS_CART_SIGN_IN_MODE] = $this->anonymousCartSignInMode;
        }
        if (!is_null($this->updateProductData)) {
            $payload[static::UPDATE_PRODUCT_DATA] = $this->updateProductData;
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
