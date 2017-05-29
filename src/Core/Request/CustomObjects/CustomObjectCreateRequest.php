<?php
/**
 * @author @jayS-de <jens.schulze@commercetools.de>
 */

namespace Commercetools\Core\Request\CustomObjects;

use Commercetools\Core\Error\InvalidArgumentException;
use Commercetools\Core\Model\Common\Context;
use Commercetools\Core\Model\CustomObject\CustomObject;
use Commercetools\Core\Model\CustomObject\CustomObjectDraft;
use Commercetools\Core\Request\AbstractCreateRequest;
use Commercetools\Core\Response\ApiResponseInterface;
use Commercetools\Core\Model\MapperInterface;

/**
 * @package Commercetools\Core\Request\CustomObjects
 * @link https://dev.commercetools.com/http-api-projects-custom-objects.html#create-a-customobject
 * @method CustomObject mapResponse(ApiResponseInterface $response)
 * @method CustomObject mapFromResponse(ApiResponseInterface $response, MapperInterface $mapper = null)
 */
class CustomObjectCreateRequest extends AbstractCreateRequest
{
    protected $resultClass = CustomObject::class;

    /**
     * @param CustomObjectDraft|CustomObject $customObject
     * @param Context $context
     */
    public function __construct($customObject, Context $context = null)
    {
        if (!($customObject instanceof CustomObject || $customObject instanceof CustomObjectDraft)) {
            throw new InvalidArgumentException();
        }
        parent::__construct(CustomObjectsEndpoint::endpoint(), $customObject, $context);
    }

    /**
     * @param CustomObjectDraft|CustomObject $customObject
     * @param Context $context
     * @return static
     */
    public static function ofObject($customObject, Context $context = null)
    {
        return new static($customObject, $context);
    }

    /**
     * @param CustomObjectDraft $customObject
     * @param Context|null $context
     * @return static
     */
    public static function ofDraft(CustomObjectDraft $customObject, Context $context = null)
    {
        return new static($customObject, $context);
    }
}
