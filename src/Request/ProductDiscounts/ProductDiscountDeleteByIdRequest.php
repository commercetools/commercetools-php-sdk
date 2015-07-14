<?php
/**
 * @author @ct-jensschulze <jens.schulze@commercetools.de>
 */

namespace Sphere\Core\Request\ProductDiscounts;

use Sphere\Core\Model\Common\Context;
use Sphere\Core\Request\AbstractDeleteByIdRequest;
use Sphere\Core\Model\ProductDiscount\ProductDiscount;
use Sphere\Core\Response\ApiResponseInterface;

/**
 * Class ProductDiscountDeleteByIdRequest
 * @package Sphere\Core\Request\ProductDiscounts
 * @link http://dev.sphere.io/http-api-projects-productDiscounts.html#delete-product-discount
 * @method ProductDiscount mapResponse(ApiResponseInterface $response)
 */
class ProductDiscountDeleteByIdRequest extends AbstractDeleteByIdRequest
{
    protected $resultClass = '\Sphere\Core\Model\ProductDiscount\ProductDiscount';

    /**
     * @param string $id
     * @param int $version
     * @param Context $context
     */
    public function __construct($id, $version, Context $context = null)
    {
        parent::__construct(ProductDiscountsEndpoint::endpoint(), $id, $version, $context);
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
