<?php
/**
 * @author @ct-jensschulze <jens.schulze@commercetools.de>
 */

namespace Sphere\Core\Request\CustomObjects;


use Sphere\Core\Model\Common\Context;
use Sphere\Core\Model\CustomObject\CustomObject;
use Sphere\Core\Request\AbstractCreateRequest;

/**
 * Class CustomObjectCreateRequest
 * @package Sphere\Core\Request\CustomObjects
 * @link http://dev.sphere.io/http-api-projects-custom-objects.html#create-custom-object
 */
class CustomObjectCreateRequest extends AbstractCreateRequest
{
    protected $resultClass = '\Sphere\Core\Model\CustomObject\CustomObject';

    /**
     * @param CustomObject $customObject
     * @param Context $context
     */
    public function __construct(CustomObject $customObject, Context $context = null)
    {
        parent::__construct(CustomObjectsEndpoint::endpoint(), $customObject, $context);
    }

    /**
     * @param CustomObject $customObject
     * @param Context $context
     * @return static
     */
    public static function ofObject(CustomObject $customObject, Context $context = null)
    {
        return new static($customObject, $context);
    }
}
