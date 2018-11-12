<?php
/**
 *
 */

namespace Commercetools\Core\Request\OrderEdits;

use Commercetools\Core\Client\HttpMethod;
use Commercetools\Core\Client\JsonRequest;
use Commercetools\Core\Model\Common\Context;
use Commercetools\Core\Model\OrderEdit\OrderEdit;
use Commercetools\Core\Request\AbstractApiRequest;
use Commercetools\Core\Response\ResourceResponse;
use Psr\Http\Message\ResponseInterface;
use Commercetools\Core\Response\ApiResponseInterface;
use Commercetools\Core\Model\MapperInterface;

/**
 * @package Commercetools\Core\Request\OrderEdits
 *
 * @method OrderEdit mapResponse(ApiResponseInterface $response)
 * @method OrderEdit mapFromResponse(ApiResponseInterface $response, MapperInterface $mapper = null)
 */
class OrderEditApplyRequest extends AbstractApiRequest
{
    protected $resultClass = OrderEdit::class;

    const EDIT_VERSION = 'editVersion';
    const RESOURCE_VERSION = 'resourceVersion';

    /**
     * @var string
     */
    protected $id;

    /**
     * @var int
     */
    protected $version;
    /**
     * @var int
     */
    protected $resourceVersion;

    /**
     * OrderEditApplyRequest constructor.
     * @param $id
     * @param $version
     * @param $resourceVersion
     * @param Context|null $context
     */
    public function __construct($id, $version, $resourceVersion, Context $context = null)
    {
        parent::__construct(OrderEditsEndpoint::endpoint(), $context);
        $this->id = $id;
        $this->version = $version;
        $this->resourceVersion = $resourceVersion;
    }

    /**
     * @param string $id
     * @param int $version
     * @param $resourceVersion
     * @param Context $context
     * @return static
     */
    public static function ofIdVersionAndResourceVersion($id, $version, $resourceVersion, Context $context = null)
    {
        return new static($id, $version, $resourceVersion, $context);
    }

    /**
     * @return string
     * @internal
     */
    protected function getPath()
    {
        return (string)$this->getEndpoint() . '/' .  $this->id . '/apply' . $this->getParamString();
    }

    /**
     * @return JsonRequest
     * @internal
     */
    public function httpRequest()
    {
        $payload = [
            static::EDIT_VERSION => (int)$this->version,
            static::RESOURCE_VERSION => (int)$this->resourceVersion,
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
