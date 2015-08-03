<?php
/**
 * @author @ct-jensschulze <jens.schulze@commercetools.de>
 */

namespace Commercetools\Core\Request\ProductTypes;

use Commercetools\Core\Model\Common\Context;
use Commercetools\Core\Request\AbstractByIdGetRequest;
use Commercetools\Core\Model\ProductType\ProductType;
use Commercetools\Core\Response\ApiResponseInterface;

/**
 * @package Commercetools\Core\Request\ProductTypes
 * @apidoc http://dev.sphere.io/http-api-projects-productTypes.html#product-type-by-id
 * @method ProductType mapResponse(ApiResponseInterface $response)
 */
class ProductTypeByIdGetRequest extends AbstractByIdGetRequest
{
    protected $resultClass = '\Commercetools\Core\Model\ProductType\ProductType';

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
