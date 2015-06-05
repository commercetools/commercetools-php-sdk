<?php
/**
 * @author @ct-jensschulze <jens.schulze@commercetools.de>
 */

namespace Sphere\Core\Request\CustomObjects;


use Psr\Http\Message\ResponseInterface;
use Sphere\Core\Model\Common\Context;
use Sphere\Core\Request\AbstractApiRequest;
use Sphere\Core\Response\SingleResourceResponse;

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
     * @return string
     * @internal
     */
    protected function getPath()
    {
        return (string)$this->getEndpoint() . '/' . $this->container . '/' . $this->key;
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
