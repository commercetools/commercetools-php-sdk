<?php
/**
 * @author @jenschude <jens.schulze@commercetools.de>
 */

namespace Commercetools\Core\Request\CustomObjects;

use Commercetools\Core\Model\Common\Context;
use Commercetools\Core\Request\AbstractQueryRequest;
use Commercetools\Core\Model\CustomObject\CustomObjectCollection;
use Commercetools\Core\Response\ApiResponseInterface;
use Commercetools\Core\Model\MapperInterface;

/**
 * @package Commercetools\Core\Request\CustomObjects
 * @link https://docs.commercetools.com/http-api-projects-custom-objects.html#query-customobjects
 * @method CustomObjectCollection mapResponse(ApiResponseInterface $response)
 * @method CustomObjectCollection mapFromResponse(ApiResponseInterface $response, MapperInterface $mapper = null)
 */
class CustomObjectQueryRequest extends AbstractQueryRequest
{
    protected $resultClass = CustomObjectCollection::class;

    /**
     * @param Context $context
     */
    public function __construct(Context $context = null)
    {
        parent::__construct(CustomObjectsEndpoint::endpoint(), $context);
    }

    /**
     * @param Context $context
     * @return static
     */
    public static function of(Context $context = null)
    {
        return new static($context);
    }
}
