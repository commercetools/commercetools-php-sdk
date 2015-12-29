<?php
/**
 * @author @jayS-de <jens.schulze@commercetools.de>
 */

namespace Commercetools\Core\Request\ProductTypes;

use Commercetools\Core\Model\Common\Context;
use Commercetools\Core\Model\ProductType\ProductTypeDraft;
use Commercetools\Core\Request\AbstractCreateRequest;
use Commercetools\Core\Model\ProductType\ProductType;
use Commercetools\Core\Response\ApiResponseInterface;

/**
 * @package Commercetools\Core\Request\ProductTypes
 *
 * @method ProductType mapResponse(ApiResponseInterface $response)
 */
class ProductTypeCreateRequest extends AbstractCreateRequest
{
    protected $resultClass = '\Commercetools\Core\Model\ProductType\ProductType';

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
