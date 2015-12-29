<?php
/**
 * @author @jayS-de <jens.schulze@commercetools.de>
 */

namespace Commercetools\Core\Request\CustomObjects;

use Commercetools\Core\Model\Common\Context;
use Commercetools\Core\Model\CustomObject\CustomObject;
use Commercetools\Core\Request\AbstractCreateRequest;
use Commercetools\Core\Response\ApiResponseInterface;

/**
 * @package Commercetools\Core\Request\CustomObjects
 * @apidoc http://dev.sphere.io/http-api-projects-custom-objects.html#create-custom-object
 * @method CustomObject mapResponse(ApiResponseInterface $response)
 */
class CustomObjectCreateRequest extends AbstractCreateRequest
{
    protected $resultClass = '\Commercetools\Core\Model\CustomObject\CustomObject';

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
