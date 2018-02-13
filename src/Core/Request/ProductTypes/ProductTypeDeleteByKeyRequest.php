<?php
/**
 * @author @jenschude <jens.schulze@commercetools.de>
 */

namespace Commercetools\Core\Request\ProductTypes;

use Commercetools\Core\Model\Common\Context;
use Commercetools\Core\Request\AbstractDeleteByKeyRequest;
use Commercetools\Core\Model\ProductType\ProductType;
use Commercetools\Core\Response\ApiResponseInterface;
use Commercetools\Core\Model\MapperInterface;

/**
 * @package Commercetools\Core\Request\ProductTypes
 * @link https://docs.commercetools.com/http-api-projects-productTypes.html#delete-producttype-by-key
 * @method ProductType mapResponse(ApiResponseInterface $response)
 * @method ProductType mapFromResponse(ApiResponseInterface $response, MapperInterface $mapper = null)
 */
class ProductTypeDeleteByKeyRequest extends AbstractDeleteByKeyRequest
{
    protected $resultClass = ProductType::class;

    /**
     * @param string $key
     * @param int $version
     * @param Context $context
     */
    public function __construct($key, $version, Context $context = null)
    {
        parent::__construct(ProductTypesEndpoint::endpoint(), $key, $version, $context);
    }

    /**
     * @param string $key
     * @param int $version
     * @param Context $context
     * @return static
     */
    public static function ofKeyAndVersion($key, $version, Context $context = null)
    {
        return new static($key, $version, $context);
    }
}
