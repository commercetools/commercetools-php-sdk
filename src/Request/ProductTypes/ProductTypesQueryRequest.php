<?php
/**
 * @author @ct-jensschulze <jens.schulze@commercetools.de>
 */

namespace Sphere\Core\Request\ProductTypes;


use Sphere\Core\Model\Common\Context;
use Sphere\Core\Request\AbstractQueryRequest;

/**
 * Class ProductTypesQueryRequest
 * @package Sphere\Core\Request\ProductTypes
 * @link http://dev.sphere.io/http-api-projects-productTypes.html#product-types-by-query
 */
class ProductTypesQueryRequest extends AbstractQueryRequest
{
    protected $resultClass = '\Sphere\Core\Model\ProductType\ProductTypeCollection';

    /**
     * @param Context $context
     */
    public function __construct(Context $context = null)
    {
        parent::__construct(ProductTypesEndpoint::endpoint(), $context);
    }
}
