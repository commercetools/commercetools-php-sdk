<?php
/**
 * @author @ct-jensschulze <jens.schulze@commercetools.de>
 */

namespace Sphere\Core\Request\Products;

use Psr\Http\Message\ResponseInterface;
use Sphere\Core\Client\HttpMethod;
use Sphere\Core\Client\HttpRequest;
use Sphere\Core\Model\Common\Context;
use Sphere\Core\Request\AbstractApiRequest;
use Sphere\Core\Request\ExpandTrait;
use Sphere\Core\Request\PageTrait;
use Sphere\Core\Request\QueryTrait;
use Sphere\Core\Request\StagedTrait;
use Sphere\Core\Response\SingleResourceResponse;
use Sphere\Core\Model\Product\ProductProjection;
use Sphere\Core\Model\Common\JsonObject;
use Sphere\Core\Response\ApiResponseInterface;

/**
 * Class ProductProjectionFetchBySkuRequest
 * @package Sphere\Core\Request\Products
 * @method ProductProjection mapResponse(ApiResponseInterface $response)
 */
class ProductProjectionFetchBySkuRequest extends AbstractApiRequest
{
    protected $resultClass = '\Sphere\Core\Model\Product\ProductProjection';

    use QueryTrait;
    use StagedTrait;
    use PageTrait;
    use ExpandTrait;

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
     * @return SingleResourceResponse
     */
    public function buildResponse(ResponseInterface $response)
    {
        return new SingleResourceResponse($response, $this, $this->getContext());
    }

    /**
     * @param array $result
     * @param Context $context
     * @return ProductProjection|null
     */
    public function mapResult(array $result, Context $context = null)
    {
        if (!empty($result['results'])) {
            $data = current($result['results']);
            return ProductProjection::fromArray($data, $context);
        }
        return null;
    }
}
