<?php
/**
 * @author @jayS-de <jens.schulze@commercetools.de>
 */

namespace Commercetools\Core\Request\Me;

use Commercetools\Core\Client\HttpMethod;
use Commercetools\Core\Client\HttpRequest;
use Commercetools\Core\Client\JsonRequest;
use Commercetools\Core\Model\Common\Context;
use Commercetools\Core\Model\Customer\Customer;
use Commercetools\Core\Request\AbstractUpdateRequest;
use Commercetools\Core\Response\ApiResponseInterface;

/**
 * @package Commercetools\Core\Request\Me
 * @link https://dev.commercetools.com/http-api-projects-me-profile.html#update-customer
 * @method Customer mapResponse(ApiResponseInterface $response)
 */
class MeUpdateRequest extends AbstractUpdateRequest
{
    protected $resultClass = '\Commercetools\Core\Model\Customer\Customer';

    /**
     * @param int $version
     * @param Context $context
     */
    public function __construct($version, Context $context = null)
    {
        parent::__construct(MeEndpoint::endpoint(), null, $version, $context);
    }

    /**
     * @param int $version
     * @param Context $context
     * @return static
     */
    public static function ofVersion($version, Context $context = null)
    {
        return new static($version, $context);
    }

    /**
     * @return string
     * @internal
     */
    protected function getPath()
    {
        return (string)$this->getEndpoint() . $this->getParamString();
    }

    /**
     * @return HttpRequest
     * @internal
     */
    public function httpRequest()
    {
        $payload = [static::VERSION => $this->getVersion(), static::ACTIONS => $this->getActions()];
        return new JsonRequest(HttpMethod::POST, $this->getPath(), $payload);
    }
}
