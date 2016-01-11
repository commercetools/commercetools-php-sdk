<?php
/**
 * @author @jayS-de <jens.schulze@commercetools.de>
 */

namespace Commercetools\Core\Request\ProductTypes;

use Commercetools\Core\Model\Common\Context;
use Commercetools\Core\Model\ProductType\ProductType;
use Commercetools\Core\Request\AbstractByKeyGetRequest;
use Commercetools\Core\Response\ApiResponseInterface;

/**
 * @package Commercetools\Core\Request\ProductTypes
 * @apidoc http://dev.sphere.io/http-api-projects-productTypes.html#product-type-by-key
 * @method ProductType mapResponse(ApiResponseInterface $response)
 */
class ProductTypeByKeyGetRequest extends AbstractByKeyGetRequest
{
    protected $resultClass = '\Commercetools\Core\Model\ProductType\ProductType';

    /**
     * @param string $key
     * @param Context $context
     */
    public function __construct($key, Context $context = null)
    {
        parent::__construct(ProductTypesEndpoint::endpoint(), $key, $context);
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
