<?php
/**
 * @author @jenschude <jens.schulze@commercetools.de>
 */

namespace Commercetools\Core\Request\Products;

use Commercetools\Core\Model\Common\Collection;
use Commercetools\Core\Model\MapperInterface;
use Commercetools\Core\Request\PriceSelectTrait;
use Psr\Http\Message\ResponseInterface;
use Commercetools\Core\Client\HttpMethod;
use Commercetools\Core\Client\HttpRequest;
use Commercetools\Core\Model\Common\Context;
use Commercetools\Core\Request\AbstractApiRequest;
use Commercetools\Core\Request\ExpandTrait;
use Commercetools\Core\Request\PageTrait;
use Commercetools\Core\Request\QueryTrait;
use Commercetools\Core\Request\StagedTrait;
use Commercetools\Core\Response\ResourceResponse;
use Commercetools\Core\Model\Product\ProductProjection;
use Commercetools\Core\Response\ApiResponseInterface;

/**
 * @package Commercetools\Core\Request\Products
 * @method ProductProjection mapResponse(ApiResponseInterface $response)
 * @method ProductProjection mapFromResponse(ApiResponseInterface $response, MapperInterface $mapper = null)
 */
class ProductProjectionBySkuGetRequest extends AbstractApiRequest
{
    protected $resultClass = ProductProjection::class;

    use QueryTrait;
    use StagedTrait;
    use PageTrait;
    use ExpandTrait;
    use PriceSelectTrait;

    /**
     * @param string $sku
     * @param Context $context
     */
    public function __construct($sku, Context $context = null)
    {
        parent::__construct(ProductProjectionEndpoint::endpoint(), $context);
        if (!is_null($sku)) {
            $this->where(sprintf('masterVariant(sku="%1$s") or variants(sku="%1$s")', $sku));
        }
        $this->limit(1);
    }

    /**
     * @param string $sku
     * @param Context $context
     * @return static
     */
    public static function ofSku($sku, Context $context = null)
    {
        return new static($sku, $context);
    }

    /**
     * @return HttpRequest
     * @internal
     */
    public function httpRequest()
    {
        return new HttpRequest(HttpMethod::GET, $this->getPath());
    }

    /**
     * @param ResponseInterface $response
     * @return ResourceResponse
     */
    public function buildResponse(ResponseInterface $response)
    {
        return new ResourceResponse($response, $this, $this->getContext());
    }

    /**
     * @param array $result
     * @param Context $context
     * @param MapperInterface $mapper
     * @return Collection
     */
    public function map(array $result, Context $context = null, MapperInterface $mapper = null)
    {
        if (!empty($result['results'])) {
            $data = current($result['results']);
            return parent::map($data, $context);
        }
        return null;
    }
}
