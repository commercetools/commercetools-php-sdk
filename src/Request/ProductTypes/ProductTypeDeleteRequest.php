<?php
/**
 * @author @ct-jensschulze <jens.schulze@commercetools.de>
 */

namespace Sphere\Core\Request\ProductTypes;

use Sphere\Core\Model\Common\Context;
use Sphere\Core\Request\AbstractDeleteRequest;
use Sphere\Core\Model\ProductType\ProductType;
use Sphere\Core\Response\ApiResponseInterface;

/**
 * @package Sphere\Core\Request\ProductTypes
 * @link http://dev.sphere.io/http-api-projects-productTypes.html#delete-product-type
 * @method ProductType mapResponse(ApiResponseInterface $response)
 */
class ProductTypeDeleteRequest extends AbstractDeleteRequest
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
