<?php
/**
 * @author @jayS-de <jens.schulze@commercetools.de>
 */

namespace Commercetools\Core\Request\CustomObjects;

use Commercetools\Core\Model\Common\Context;
use Commercetools\Core\Model\CustomObject\CustomObject;
use Commercetools\Core\Model\CustomObject\CustomObjectDraft;
use Commercetools\Core\Request\AbstractCreateRequest;
use Commercetools\Core\Response\ApiResponseInterface;

/**
 * @package Commercetools\Core\Request\CustomObjects
 * @link http://dev.commercetools.com/http-api-projects-custom-objects.html#create-custom-object
 * @method CustomObject mapResponse(ApiResponseInterface $response)
 */
class CustomObjectCreateRequest extends AbstractCreateRequest
{
    protected $resultClass = '\Commercetools\Core\Model\CustomObject\CustomObject';

    /**
     * @param CustomObjectDraft $customObject
     * @param Context $context
     */
    public function __construct(CustomObjectDraft $customObject, Context $context = null)
    {
        parent::__construct(CustomObjectsEndpoint::endpoint(), $customObject, $context);
    }

    /**
     * @param CustomObjectDraft $customObject
     * @param Context $context
     * @return static
     */
    public static function ofObject(CustomObjectDraft $customObject, Context $context = null)
    {
        return new static($customObject, $context);
    }
}
