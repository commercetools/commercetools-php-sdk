<?php
/**
 * @author @ct-jensschulze <jens.schulze@commercetools.de>
 */

namespace Sphere\Core\Request\ProductTypes;


use Sphere\Core\Model\Common\Context;
use Sphere\Core\Request\AbstractFetchByIdRequest;

/**
 * Class ProductTypeFetchByIdRequest
 * @package Sphere\Core\Request\ProductTypes
 * @link http://dev.sphere.io/http-api-projects-productTypes.html#product-type-by-id
 */
class ProductTypeFetchByIdRequest extends AbstractFetchByIdRequest
{
    protected $resultClass = '\Sphere\Core\Model\ProductType\ProductType';

    /**
     * @param string $id
     * @param Context $context
     */
    public function __construct($id, Context $context = null)
    {
        parent::__construct(ProductTypesEndpoint::endpoint(), $id, $context);
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
