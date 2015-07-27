<?php
/**
 * @author @ct-jensschulze <jens.schulze@commercetools.de>
 */

namespace Sphere\Core\Request\CustomObjects;


use Psr\Http\Message\ResponseInterface;
use Sphere\Core\Model\Common\Context;
use Sphere\Core\Request\AbstractApiRequest;
use Sphere\Core\Response\ResourceResponse;

/**
 * Class AbstractCustomObjectRequest
 * @package Sphere\Core\Request\CustomObjects
 */
abstract class AbstractCustomObjectRequest extends AbstractApiRequest
{
    protected $resultClass = '\Sphere\Core\Model\CustomObject\CustomObject';

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
        return (string)$this->getEndpoint() . '/' . $this->container . '/' . $this->key;
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
