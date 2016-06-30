<?php
/**
 * @author @jayS-de <jens.schulze@commercetools.de>
 */

namespace Commercetools\Core\Request\Me;

use Commercetools\Core\Client\HttpMethod;
use Commercetools\Core\Client\JsonRequest;
use Commercetools\Core\Model\Common\Context;
use Commercetools\Core\Request\AbstractApiRequest;
use Commercetools\Core\Response\ResourceResponse;
use Psr\Http\Message\ResponseInterface;
use Commercetools\Core\Model\Customer\Customer;
use Commercetools\Core\Response\ApiResponseInterface;

/**
 * @package Commercetools\Core\Request\Me
 * @link https://dev.commercetools.com/http-api-projects-me-profile.html#reset-customers-password
 * @method Customer mapResponse(ApiResponseInterface $response)
 */
class MePasswordResetRequest extends AbstractApiRequest
{
    const TOKEN_VALUE = 'tokenValue';
    const NEW_PASSWORD = 'newPassword';

    protected $resultClass = '\Commercetools\Core\Model\Customer\Customer';

    /**
     * @var string
     */
    protected $token;

    /**
     * @var string
     */
    protected $newPassword;

    /**
     * @param string $token
     * @param string $newPassword
     * @param Context $context
     */
    public function __construct($token, $newPassword, Context $context = null)
    {
        parent::__construct(MeEndpoint::endpoint(), $context);
        $this->token = $token;
        $this->newPassword = $newPassword;
    }

    /**
     * @param string $token
     * @param string $newPassword
     * @param Context $context
     * @return static
     */
    public static function ofTokenAndPassword(
        $token,
        $newPassword,
        Context $context = null
    ) {
        return new static($token, $newPassword, $context);
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
            static::TOKEN_VALUE => $this->token,
            static::NEW_PASSWORD => $this->newPassword
        ];
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
