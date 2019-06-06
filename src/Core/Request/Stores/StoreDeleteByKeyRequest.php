<?php
/**
 */

namespace Commercetools\Core\Request\Stores;

use Commercetools\Core\Model\Common\Context;
use Commercetools\Core\Model\Store\Store;
use Commercetools\Core\Request\AbstractDeleteByKeyRequest;
use Commercetools\Core\Response\ApiResponseInterface;
use Commercetools\Core\Model\MapperInterface;

/**
 * @package Commercetools\Core\Request\Stores
 * @link https://docs.commercetools.com/http-api-projects-stores#delete-store-by-key
 * @method Store mapResponse(ApiResponseInterface $response)
 * @method Store mapFromResponse(ApiResponseInterface $response, MapperInterface $mapper = null)
 */
class StoreDeleteByKeyRequest extends AbstractDeleteByKeyRequest
{
    protected $resultClass = Store::class;

    /**
     * @param string $id
     * @param int $version
     * @param Context $context
     */
    public function __construct($id, $version, Context $context = null)
    {
        parent::__construct(StoresEndpoint::endpoint(), $id, $version, $context);
    }

    /**
     * @param string $key
     * @param int $version
     * @param Context $context
     * @return static
     */
    public static function ofKeyAndVersion($key, $version, Context $context = null)
    {
        return new static($key, $version, $context);
    }
}
