<?php
/**
 * @author @jenschude <jens.schulze@commercetools.de>
 */

namespace Commercetools\Core\Request\ProductTypes;

use Commercetools\Core\Model\Common\Context;
use Commercetools\Core\Model\ProductType\ProductType;
use Commercetools\Core\Request\AbstractByKeyGetRequest;
use Commercetools\Core\Response\ApiResponseInterface;
use Commercetools\Core\Model\MapperInterface;

/**
 * @package Commercetools\Core\Request\ProductTypes
 * @link https://docs.commercetools.com/http-api-projects-productTypes.html#get-a-producttype-by-key
 * @method ProductType mapResponse(ApiResponseInterface $response)
 * @method ProductType mapFromResponse(ApiResponseInterface $response, MapperInterface $mapper = null)
 */
class ProductTypeByKeyGetRequest extends AbstractByKeyGetRequest
{
    protected $resultClass = ProductType::class;

    /**
     * @param string $key
     * @param Context $context
     */
    public function __construct($key, Context $context = null)
    {
        parent::__construct(ProductTypesEndpoint::endpoint(), $key, $context);
    }

    /**
     * @param string $key
     * @param Context $context
     * @return static
     */
    public static function ofKey($key, Context $context = null)
    {
        return new static($key, $context);
    }
}
