<?php
/**
 * @author @jenschude <jens.schulze@commercetools.de>
 */

namespace Commercetools\Core\Request\ProductTypes;

use Commercetools\Core\Model\Common\Context;
use Commercetools\Core\Model\ProductType\ProductTypeDraft;
use Commercetools\Core\Request\AbstractCreateRequest;
use Commercetools\Core\Model\ProductType\ProductType;
use Commercetools\Core\Response\ApiResponseInterface;
use Commercetools\Core\Model\MapperInterface;

/**
 * @package Commercetools\Core\Request\ProductTypes
 * @link https://docs.commercetools.com/http-api-projects-productTypes.html#create-a-producttype
 * @method ProductType mapResponse(ApiResponseInterface $response)
 * @method ProductType mapFromResponse(ApiResponseInterface $response, MapperInterface $mapper = null)
 */
class ProductTypeCreateRequest extends AbstractCreateRequest
{
    protected $resultClass = ProductType::class;

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
