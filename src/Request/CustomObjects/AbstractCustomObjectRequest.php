<?php
/**
 * @author @jayS-de <jens.schulze@commercetools.de>
 */

namespace Commercetools\Core\Request\CustomObjects;

use Commercetools\Core\Model\CustomObject\CustomObject;
use Psr\Http\Message\ResponseInterface;
use Commercetools\Core\Model\Common\Context;
use Commercetools\Core\Request\AbstractApiRequest;
use Commercetools\Core\Response\ResourceResponse;

/**
 * @package Commercetools\Core\Request\CustomObjects
 */
abstract class AbstractCustomObjectRequest extends AbstractApiRequest
{
    protected $resultClass = CustomObject::class;

    /**
     * @var string
     */
    protected $container;

    /**
     * @var string
     */
    protected $key;

    /**
     * @param string $container
     * @param string $key
     * @param Context $context
     */
    public function __construct($container, $key, Context $context = null)
    {
        parent::__construct(CustomObjectsEndpoint::endpoint(), $context);
        $this->container = $container;
        $this->key = $key;
    }


    /**
     * @param string $container
     * @param string $key
     * @param Context $context
     * @return static
     */
    public static function ofContainerAndKey($container, $key, Context $context = null)
    {
        return new static($container, $key, $context);
    }

    /**
     * @return string
     * @internal
     */
    protected function getPath()
    {
        return (string)$this->getEndpoint() . '/' . $this->container . '/' . $this->key . $this->getParamString();
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
