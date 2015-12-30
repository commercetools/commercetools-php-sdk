<?php
/**
 * @author @jayS-de <jens.schulze@commercetools.de>
 */

namespace Commercetools\Core\Request\ProductTypes;

use Commercetools\Core\Model\Common\Context;
use Commercetools\Core\Request\AbstractUpdateByKeyRequest;
use Commercetools\Core\Model\ProductType\ProductType;
use Commercetools\Core\Response\ApiResponseInterface;

/**
 * @package Commercetools\Core\Request\ProductTypes
 * @apidoc http://dev.sphere.io/http-api-projects-productTypes.html#update-product-type
 * @method ProductType mapResponse(ApiResponseInterface $response)
 */
class ProductTypeUpdateByKeyRequest extends AbstractUpdateByKeyRequest
{
    protected $resultClass = '\Commercetools\Core\Model\ProductType\ProductType';

    /**
     * @param string $key
     * @param string $version
     * @param array $actions
     * @param Context $context
     */
    public function __construct($key, $version, array $actions = [], Context $context = null)
    {
        parent::__construct(ProductTypesEndpoint::endpoint(), $key, $version, $actions, $context);
    }

    /**
     * @param string $key
     * @param int $version
     * @param Context $context
     * @return static
     */
    public static function ofKeyAndVersion($key, $version, Context $context = null)
    {
        return new static($key, $version, [], $context);
    }
}
