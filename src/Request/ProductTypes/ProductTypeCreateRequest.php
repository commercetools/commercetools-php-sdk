<?php
/**
 * @author @ct-jensschulze <jens.schulze@commercetools.de>
 */

namespace Sphere\Core\Request\ProductTypes;

use Sphere\Core\Model\Common\Context;
use Sphere\Core\Model\ProductType\ProductTypeDraft;
use Sphere\Core\Request\AbstractCreateRequest;
use Sphere\Core\Model\ProductType\ProductType;
use Sphere\Core\Response\ApiResponseInterface;

/**
 * @package Sphere\Core\Request\ProductTypes
 * 
 * @method ProductType mapResponse(ApiResponseInterface $response)
 */
class ProductTypeCreateRequest extends AbstractCreateRequest
{
    protected $resultClass = '\Sphere\Core\Model\ProductType\ProductType';

    /**
     * @param ProductTypeDraft $productType
     * @param Context $context
     */
    public function __construct(ProductTypeDraft $productType, Context $context = null)
    {
        parent::__construct(ProductTypesEndpoint::endpoint(), $productType, $context);
    }

    /**
     * @param ProductTypeDraft $productType
     * @param Context $context
     * @return static
     */
    public static function ofDraft(ProductTypeDraft $productType, Context $context = null)
    {
        return new static($productType, $context);
    }
}
