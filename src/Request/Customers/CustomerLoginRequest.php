<?php
/**
 * @author @ct-jensschulze <jens.schulze@commercetools.de>
 * @created: 11.02.15, 15:53
 */

namespace Sphere\Core\Request\Customers;

use GuzzleHttp\Message\ResponseInterface;
use Sphere\Core\Client\HttpMethod;
use Sphere\Core\Client\JsonRequest;
use Sphere\Core\Model\Common\Context;
use Sphere\Core\Model\Common\JsonDeserializeInterface;
use Sphere\Core\Model\Common\JsonObject;
use Sphere\Core\Model\Customer\CustomerSigninResult;
use Sphere\Core\Request\AbstractApiRequest;
use Sphere\Core\Response\SingleResourceResponse;

class CustomerLoginRequest extends AbstractApiRequest
{
    const EMAIL = 'email';
    const PASSWORD = 'password';
    const ANONYMOUS_CART_ID = 'anonymousCartId';

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

    protected $resultClass = '\Sphere\Core\Model\Customer\CustomerSigninResult';

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
