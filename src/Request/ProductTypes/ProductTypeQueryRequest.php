<?php
/**
 * @author @ct-jensschulze <jens.schulze@commercetools.de>
 */

namespace Sphere\Core\Request\ProductTypes;

use Sphere\Core\Model\Common\Context;
use Sphere\Core\Request\AbstractQueryRequest;
use Sphere\Core\Model\ProductType\ProductTypeCollection;
use Sphere\Core\Response\ApiResponseInterface;

/**
 * @package Sphere\Core\Request\ProductTypes
 * @apidoc http://dev.sphere.io/http-api-projects-productTypes.html#product-types-by-query
 * @method ProductTypeCollection mapResponse(ApiResponseInterface $response)
 */
class ProductTypeQueryRequest extends AbstractQueryRequest
{
    protected $resultClass = '\Sphere\Core\Model\ProductType\ProductTypeCollection';

    /**
     * @param Context $context
     */
    public function __construct(Context $context = null)
    {
        parent::__construct(ProductTypesEndpoint::endpoint(), $context);
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
