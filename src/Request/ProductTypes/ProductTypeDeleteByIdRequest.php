<?php
/**
 * @author @ct-jensschulze <jens.schulze@commercetools.de>
 */

namespace Sphere\Core\Request\ProductTypes;


use Sphere\Core\Model\Common\Context;
use Sphere\Core\Request\AbstractDeleteByIdRequest;

/**
 * Class ProductTypeDeleteByIdRequest
 * @package Sphere\Core\Request\ProductTypes
 * @link http://dev.sphere.io/http-api-projects-productTypes.html#delete-product-type
 */
class ProductTypeDeleteByIdRequest extends AbstractDeleteByIdRequest
{
    protected $resultClass = '\Sphere\Core\Model\ProductType\ProductType';

    /**
     * @param string $id
     * @param int $version
     * @param Context $context
     */
    public function __construct($id, $version, Context $context = null)
    {
        parent::__construct(ProductTypesEndpoint::endpoint(), $id, $version, $context);
    }

    /**
     * @param string $id
     * @param int $version
     * @param Context $context
     * @return static
     */
    public static function ofIdAndVersion($id, $version, Context $context = null)
    {
        return new static($id, $version, $context);
    }
}
