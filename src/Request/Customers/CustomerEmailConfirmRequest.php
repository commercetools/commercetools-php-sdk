<?php
/**
 * @author @ct-jensschulze <jens.schulze@commercetools.de>
 * @created: 12.02.15, 14:18
 */

namespace Sphere\Core\Request\Customers;

use GuzzleHttp\Message\ResponseInterface;
use Sphere\Core\Client\HttpMethod;
use Sphere\Core\Client\JsonRequest;
use Sphere\Core\Model\Common\Context;
use Sphere\Core\Request\AbstractUpdateRequest;
use Sphere\Core\Response\SingleResourceResponse;

/**
 * Class CustomerEmailConfirmRequest
 * @package Sphere\Core\Request\Customers
 * @link http://dev.sphere.io/http-api-projects-customers.html#verify-customers-email
 * @method static CustomerEmailConfirmRequest of(string $id, int $version, string $tokenValue)
 */
class CustomerEmailConfirmRequest extends AbstractUpdateRequest
{
    const ID = 'id';
    const TOKEN_VALUE = 'tokenValue';

    /**
     * @var string
     */
    protected $tokenValue;

    /**
     * @param string $id
     * @param int $version
     * @param string $tokenValue
     * @param Context $context
     */
    public function __construct($id, $version, $tokenValue, Context $context = null)
    {
        parent::__construct(CustomersEndpoint::endpoint(), $id, $version, [], $context);
        $this->setId($id);
        $this->setVersion($version);
        $this->tokenValue = $tokenValue;
    }

    /**
     * @return string
     * @internal
     */
    protected function getPath()
    {
        return (string)$this->getEndpoint() . '/email/confirm';
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
        ];
        return new JsonRequest(HttpMethod::POST, $this->getPath(), $payload);
    }
}
