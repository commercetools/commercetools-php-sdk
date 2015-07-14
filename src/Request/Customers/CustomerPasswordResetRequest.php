<?php
/**
 * @author @ct-jensschulze <jens.schulze@commercetools.de>
 * @created: 12.02.15, 10:42
 */

namespace Sphere\Core\Request\Customers;

use Sphere\Core\Client\HttpMethod;
use Sphere\Core\Client\JsonRequest;
use Sphere\Core\Model\Common\Context;
use Sphere\Core\Request\AbstractUpdateRequest;
use Sphere\Core\Model\Customer\Customer;
use Sphere\Core\Response\ApiResponseInterface;

/**
 * Class CustomerPasswordResetRequest
 * @package Sphere\Core\Request\Customers
 * @link http://dev.sphere.io/http-api-projects-customers.html#reset-customers-password
 * @method Customer mapResponse(ApiResponseInterface $response)
 */
class CustomerPasswordResetRequest extends AbstractUpdateRequest
{
    const ID = 'id';
    const VERSION = 'version';
    const TOKEN_VALUE = 'tokenValue';
    const NEW_PASSWORD = 'newPassword';

    protected $resultClass = '\Sphere\Core\Model\Customer\Customer';

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
    public function __construct($id, $version, $tokenValue, $newPassword, Context $context = null)
    {
        parent::__construct(CustomersEndpoint::endpoint(), $id, $version, [], $context);
        $this->setId($id);
        $this->setVersion($version);
        $this->tokenValue = $tokenValue;
        $this->newPassword = $newPassword;
    }

    /**
     * @param string $id
     * @param int $version
     * @param string $tokenValue
     * @param string $newPassword
     * @param Context $context
     * @return static
     */
    public static function ofIdVersionTokenAndPassword(
        $id,
        $version,
        $tokenValue,
        $newPassword,
        Context $context = null
    ) {
        return new static($id, $version, $tokenValue, $newPassword, $context);
    }

    /**
     * @return string
     * @internal
     */
    protected function getPath()
    {
        return (string)$this->getEndpoint() . '/password/reset';
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
            static::NEW_PASSWORD => $this->newPassword
        ];
        return new JsonRequest(HttpMethod::POST, $this->getPath(), $payload);
    }
}
