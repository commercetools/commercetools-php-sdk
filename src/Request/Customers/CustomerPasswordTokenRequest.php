<?php
/**
 * @author @ct-jensschulze <jens.schulze@commercetools.de>
 * @created: 11.02.15, 17:40
 */

namespace Sphere\Core\Request\Customers;


use Psr\Http\Message\ResponseInterface;
use Sphere\Core\Client\HttpMethod;
use Sphere\Core\Client\JsonRequest;
use Sphere\Core\Model\Common\Context;
use Sphere\Core\Request\AbstractApiRequest;
use Sphere\Core\Response\SingleResourceResponse;

/**
 * Class CustomerPasswordTokenRequest
 * @package Sphere\Core\Request\Customers
 * @link http://dev.sphere.io/http-api-projects-customers.html#create-token-for-resetting-customers-password
 */
class CustomerPasswordTokenRequest extends AbstractApiRequest
{
    const EMAIL = 'email';

    protected $resultClass = '\Sphere\Core\Model\Customer\CustomerToken';

    /**
     * @var string
     */
    protected $email;

    /**
     * @param string $email
     * @param Context $context
     */
    public function __construct($email, Context $context = null)
    {
        parent::__construct(CustomersEndpoint::endpoint(), $context);
        $this->email = $email;
    }

    /**
     * @param string $email
     * @param Context $context
     * @return static
     */
    public static function ofEmail(
        $email,
        Context $context = null
    ) {
        return new static($email, $context);
    }

    /**
     * @return string
     * @internal
     */
    protected function getPath()
    {
        return (string)$this->getEndpoint() . '/password-token';
    }

    /**
     * @return JsonRequest
     * @internal
     */
    public function httpRequest()
    {
        $payload = [
            static::EMAIL => $this->email
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
