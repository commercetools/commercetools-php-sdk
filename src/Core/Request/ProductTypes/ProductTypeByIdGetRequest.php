<?php
/**
 * @author @jenschude <jens.schulze@commercetools.de>
 */

namespace Commercetools\Core\Request\ProductTypes;

use Commercetools\Core\Model\Common\Context;
use Commercetools\Core\Request\AbstractByIdGetRequest;
use Commercetools\Core\Model\ProductType\ProductType;
use Commercetools\Core\Response\ApiResponseInterface;
use Commercetools\Core\Model\MapperInterface;

/**
 * @package Commercetools\Core\Request\ProductTypes
 * @link https://docs.commercetools.com/http-api-projects-productTypes.html#get-a-producttype-by-id
 * @method ProductType mapResponse(ApiResponseInterface $response)
 * @method ProductType mapFromResponse(ApiResponseInterface $response, MapperInterface $mapper = null)
 */
class ProductTypeByIdGetRequest extends AbstractByIdGetRequest
{
    protected $resultClass = ProductType::class;

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
