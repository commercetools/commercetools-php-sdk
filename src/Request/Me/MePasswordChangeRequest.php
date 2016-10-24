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
use Commercetools\Core\Model\MapperInterface;

/**
 * @package Commercetools\Core\Request\Me
 * @link https://dev.commercetools.com/http-api-projects-me-profile.html#change-customers-password
 * @method Customer mapResponse(ApiResponseInterface $response)
 * @method Customer mapFromResponse(ApiResponseInterface $response, MapperInterface $mapper = null)
 */
class MePasswordChangeRequest extends AbstractApiRequest
{
    const ID = 'id';
    const VERSION = 'version';
    const CURRENT_PASSWORD = 'currentPassword';
    const NEW_PASSWORD = 'newPassword';

    protected $resultClass = '\Commercetools\Core\Model\Customer\Customer';

    /**
     * @var int
     */
    protected $version;

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
    public function __construct($version, $currentPassword, $newPassword, Context $context = null)
    {
        parent::__construct(MeEndpoint::endpoint(), $context);
        $this->setVersion($version);
        $this->currentPassword = $currentPassword;
        $this->newPassword = $newPassword;
    }

    /**
     * @return int
     */
    public function getVersion()
    {
        return $this->version;
    }

    /**
     * @param int $version
     * @return $this
     */
    public function setVersion($version)
    {
        $this->version = $version;

        return $this;
    }

    /**
     * @param int $version
     * @param string $currentPassword
     * @param string $newPassword
     * @param Context $context
     * @return static
     */
    public static function ofVersionAndPasswords(
        $version,
        $currentPassword,
        $newPassword,
        Context $context = null
    ) {
        return new static($version, $currentPassword, $newPassword, $context);
    }

    /**
     * @return string
     * @internal
     */
    protected function getPath()
    {
        return (string)$this->getEndpoint() . '/password' . $this->getParamString();
    }

    /**
     * @return JsonRequest
     * @internal
     */
    public function httpRequest()
    {
        $payload = [
            static::VERSION => $this->getVersion(),
            static::CURRENT_PASSWORD => $this->currentPassword,
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
