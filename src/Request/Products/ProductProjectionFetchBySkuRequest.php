<?php
/**
 * @author @ct-jensschulze <jens.schulze@commercetools.de>
 */

namespace Sphere\Core\Request\Products;

use GuzzleHttp\Message\ResponseInterface;
use Sphere\Core\Response\SingleResourceResponse;
use Sphere\Core\Model\Product\ProductProjection;

/**
 * Class ProductProjectionFetchBySkuRequest
 * @package Sphere\Core\Request\Products
 */
class ProductProjectionFetchBySkuRequest extends ProductProjectionQueryRequest
{
    /**
     * @param string $sku
     */
    public function __construct($sku)
    {
        parent::__construct();
        if (!is_null($sku)) {
            $this->where(sprintf('masterVariant(sku="%1$s") or variants(sku="%1$s")', $sku));
        }
    }

    /**
     * @param ResponseInterface $response
     * @return SingleResourceResponse
     */
    public function buildResponse(ResponseInterface $response)
    {
        return new SingleResourceResponse($response, $this);
    }

    /**
     * @param array $result
     * @return ProductProjection|null
     */
    public function mapResult(array $result)
    {
        if (isset($result['results'])) {
            $data = current($result['results']);
            return ProductProjection::fromArray($data);
        }
        return null;
    }
}
