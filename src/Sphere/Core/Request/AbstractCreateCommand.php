<?php
/**
 * @author @ct-jensschulze <jens.schulze@commercetools.de>
 * @created: 26.01.15, 17:34
 */

namespace Sphere\Core\Request;


use Sphere\Core\Http\HttpMethod;
use Sphere\Core\Http\JsonRequest;

class AbstractCreateCommand extends AbstractApiRequest
{
    /**
     * @var mixed
     */
    protected $object;

    /**
     * @param \Sphere\Core\Http\JsonEndpoint $endpoint
     * @param $object
     */
    public function __construct($endpoint, $object)
    {
        parent::__construct($endpoint);
        $this->$object = $object;
    }

    /**
     * @return mixed
     */
    public function getObject()
    {
        return $this->object;
    }

    /**
     * @param mixed $object
     */
    public function setObject($object)
    {
        $this->object = $object;
    }

    /**
     * @return JsonRequest
     */
    public function httpRequest()
    {
        return new JsonRequest(HttpMethod::POST, (string)$this->endpoint, $this->getObject());
    }
}
