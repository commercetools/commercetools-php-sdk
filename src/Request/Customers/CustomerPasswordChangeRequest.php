<?php
/**
 * @author @ct-jensschulze <jens.schulze@commercetools.de>
 * @created: 11.02.15, 16:42
 */

namespace Sphere\Core\Request\Customers;

use GuzzleHttp\Message\ResponseInterface;
use Sphere\Core\Client\HttpMethod;
use Sphere\Core\Client\JsonRequest;
use Sphere\Core\Model\Common\Context;
use Sphere\Core\Request\AbstractUpdateRequest;
use Sphere\Core\Response\SingleResourceResponse;

/**
 * Class CustomerPasswordChangeRequest
 * @package Sphere\Core\Request\Customers
 * @link http://dev.sphere.io/http-api-projects-customers.html#change-password
 */
class CustomerPasswordChangeRequest extends AbstractUpdateRequest
{
    const ID = 'id';
    const CURRENT_PASSWORD = 'currentPassword';
    const NEW_PASSWORD = 'newPassword';

    protected $resultClass = '\Sphere\Core\Model\Customer\Customer';

    /**
     * @var string
     */
    protected $currentPassword;

    /**
     * @var string
     */
    protected $newPassword;

    /**
     * @param string $id
     * @param int $version
     * @param string $currentPassword
     * @param string $newPassword
     * @param Context $context
     */
    public function __construct($id, $version, $currentPassword, $newPassword, Context $context = null)
    {
        parent::__construct(CustomersEndpoint::endpoint(), $id, $version, [], $context);
        $this->setId($id);
        $this->setVersion($version);
        $this->currentPassword = $currentPassword;
        $this->newPassword = $newPassword;
    }

    /**
     * @param string $id
     * @param int $version
     * @param string $currentPassword
     * @param string $newPassword
     * @param Context $context
     * @return static
     */
    public static function ofIdVersionAndPasswords(
        $id,
        $version,
        $currentPassword,
        $newPassword,
        Context $context = null
    ) {
        return new static($id, $version, $currentPassword, $newPassword, $context);
    }

    /**
     * @return string
     * @internal
     */
    protected function getPath()
    {
        return (string)$this->getEndpoint() . '/password';
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
            static::CURRENT_PASSWORD => $this->currentPassword,
            static::NEW_PASSWORD => $this->newPassword
        ];
        return new JsonRequest(HttpMethod::POST, $this->getPath(), $payload);
    }
}
