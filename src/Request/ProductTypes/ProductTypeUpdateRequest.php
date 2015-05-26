<?php
/**
 * @author @ct-jensschulze <jens.schulze@commercetools.de>
 */

namespace Sphere\Core\Request\ProductTypes;


use Sphere\Core\Model\Common\Context;
use Sphere\Core\Request\AbstractUpdateRequest;

/**
 * Class ProductTypeUpdateRequest
 * @package Sphere\Core\Request\ProductTypes
 * @link http://dev.sphere.io/http-api-projects-productTypes.html#update-product-type
 */
class ProductTypeUpdateRequest extends AbstractUpdateRequest
{
    protected $resultClass = '\Sphere\Core\Model\ProductType\ProductType';

    /**
     * @param string $id
     * @param string $version
     * @param array $actions
     * @param Context $context
     */
    public function __construct($id, $version, array $actions = [], Context $context = null)
    {
        parent::__construct(ProductTypesEndpoint::endpoint(), $id, $version, $actions, $context);
    }
}
