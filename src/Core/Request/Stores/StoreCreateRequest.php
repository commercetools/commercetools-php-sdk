<?php
/**
 */

namespace Commercetools\Core\Request\Stores;

use Commercetools\Core\Model\Common\Context;
use Commercetools\Core\Model\Store\Store;
use Commercetools\Core\Model\Store\StoreDraft;
use Commercetools\Core\Request\AbstractCreateRequest;
use Commercetools\Core\Response\ApiResponseInterface;
use Commercetools\Core\Model\MapperInterface;

/**
 * @package Commercetools\Core\Request\Stores
 * @link https://docs.commercetools.com/http-api-projects-stores#create-a-store
 * @method Store mapResponse(ApiResponseInterface $response)
 * @method Store mapFromResponse(ApiResponseInterface $response, MapperInterface $mapper = null)
 */
class StoreCreateRequest extends AbstractCreateRequest
{
    protected $resultClass = Store::class;

    /**
     * @param StoreDraft $store
     * @param Context $context
     */
    public function __construct(StoreDraft $store, Context $context = null)
    {
        parent::__construct(StoresEndpoint::endpoint(), $store, $context);
    }

    /**
     * @param StoreDraft $store
     * @param Context $context
     * @return static
     */
    public static function ofDraft(StoreDraft $store, Context $context = null)
    {
        return new static($store, $context);
    }
}
