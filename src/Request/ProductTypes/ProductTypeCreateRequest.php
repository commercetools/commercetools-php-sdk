<?php
/**
 * @author @ct-jensschulze <jens.schulze@commercetools.de>
 */

namespace Sphere\Core\Request\ProductTypes;


use Sphere\Core\Model\Common\Context;
use Sphere\Core\Model\ProductType\ProductTypeDraft;
use Sphere\Core\Request\AbstractCreateRequest;

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
}
