<?php
/**
 */

namespace Commercetools\Core\Request\Stores;

use Commercetools\Core\Model\Common\Context;
use Commercetools\Core\Model\Store\Store;
use Commercetools\Core\Request\AbstractByKeyGetRequest;
use Commercetools\Core\Response\ApiResponseInterface;
use Commercetools\Core\Model\MapperInterface;

/**
 * @package Commercetools\Core\Request\Stores
 * @link https://docs.commercetools.com/http-api-projects-stores#get-a-store-by-key
 * @method Store mapResponse(ApiResponseInterface $response)
 * @method Store mapFromResponse(ApiResponseInterface $response, MapperInterface $mapper = null)
 */
class StoreByKeyGetRequest extends AbstractByKeyGetRequest
{
    protected $resultClass = Store::class;

    /**
     * @param string $key
     * @param Context $context
     */
    public function __construct($key, Context $context = null)
    {
        parent::__construct(StoresEndpoint::endpoint(), $key, $context);
    }

    /**
     * @param string $key
     * @param Context $context
     * @return static
     */
    public static function ofKey($key, Context $context = null)
    {
        return new static($key, $context);
    }
}
