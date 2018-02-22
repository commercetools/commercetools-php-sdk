<?php
/**
 * @author @jenschude <jens.schulze@commercetools.de>
 */

namespace Commercetools\Core\Request\CustomObjects;

use Commercetools\Core\Model\Common\Context;
use Commercetools\Core\Model\CustomObject\CustomObject;
use Commercetools\Core\Request\AbstractByIdGetRequest;
use Commercetools\Core\Response\ApiResponseInterface;
use Commercetools\Core\Model\MapperInterface;

/**
 * @package Commercetools\Core\Request\CustomObjects
 * @method CustomObject mapResponse(ApiResponseInterface $response)
 * @method CustomObject mapFromResponse(ApiResponseInterface $response, MapperInterface $mapper = null)
 */
class CustomObjectByIdGetRequest extends AbstractByIdGetRequest
{
    protected $resultClass = CustomObject::class;

    /**
     * @param string $id
     * @param Context $context
     */
    public function __construct($id, Context $context = null)
    {
        parent::__construct(CustomObjectsEndpoint::endpoint(), $id, $context);
    }

    /**
     * @param string $id
     * @param Context $context
     * @return static
     */
    public static function ofId($id, Context $context = null)
    {
        return new static($id, $context);
    }
}
