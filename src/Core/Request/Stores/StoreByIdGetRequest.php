<?php
/**
 */

namespace Commercetools\Core\Request\Stores;

use Commercetools\Core\Model\Common\Context;
use Commercetools\Core\Model\Store\Store;
use Commercetools\Core\Request\AbstractByIdGetRequest;
use Commercetools\Core\Response\ApiResponseInterface;
use Commercetools\Core\Model\MapperInterface;

/**
 * @package Commercetools\Core\Request\Stores
 * @link https://docs.commercetools.com/http-api-projects-stores#get-a-store-by-id
 * @method Store mapResponse(ApiResponseInterface $response)
 * @method Store mapFromResponse(ApiResponseInterface $response, MapperInterface $mapper = null)
 */
class StoreByIdGetRequest extends AbstractByIdGetRequest
{
    protected $resultClass = Store::class;

    /**
     * @param string $id
     * @param Context $context
     */
    public function __construct($id, Context $context = null)
    {
        parent::__construct(StoresEndpoint::endpoint(), $id, $context);
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
