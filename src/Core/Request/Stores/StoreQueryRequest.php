<?php
/**
 */

namespace Commercetools\Core\Request\Stores;

use Commercetools\Core\Model\Common\Context;
use Commercetools\Core\Model\Store\StoreCollection;
use Commercetools\Core\Request\AbstractQueryRequest;
use Commercetools\Core\Response\ApiResponseInterface;
use Commercetools\Core\Model\MapperInterface;

/**
 * @package Commercetools\Core\Request\Stores
 * @link https://docs.commercetools.com/http-api-projects-stores#query-stores
 * @method StoreCollection mapResponse(ApiResponseInterface $response)
 * @method StoreCollection mapFromResponse(ApiResponseInterface $response, MapperInterface $mapper = null)
 */
class StoreQueryRequest extends AbstractQueryRequest
{
    protected $resultClass = StoreCollection::class;

    /**
     * @param Context $context
     */
    public function __construct(Context $context = null)
    {
        parent::__construct(StoresEndpoint::endpoint(), $context);
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
