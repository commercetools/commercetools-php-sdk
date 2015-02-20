<?php
/**
 * @author @ct-jensschulze <jens.schulze@commercetools.de>
 */

namespace Sphere\Core\Request\Products;


use GuzzleHttp\Message\ResponseInterface;
use Sphere\Core\Model\Common\Context;
use Sphere\Core\Model\Product\ProductProjection;
use Sphere\Core\Response\SingleResourceResponse;

/**
 * Class ProductProjectionFetchBySlugRequest
 * @package Sphere\Core\Request\Products
 */
class ProductProjectionFetchBySlugRequest extends ProductProjectionQueryRequest
{
    /**
     * @param string $slug
     * @param Context $context
     */
    public function __construct($slug, Context $context)
    {
        parent::__construct();
        $parts = array_map(
            function ($value) {
                return sprintf('slug(%s="%s")', $value, '%1$s');
            },
            $context->getLanguages()
        );
        if (!is_null($slug) && !empty($parts)) {
            $this->where(sprintf(implode(' or ', $parts), $slug));
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
