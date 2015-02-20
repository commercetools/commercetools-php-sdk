<?php
/**
 * @author @ct-jensschulze <jens.schulze@commercetools.de>
 */

namespace Sphere\Core\Request\Products;


use Sphere\Core\Client\HttpMethod;
use Sphere\Core\Client\HttpRequest;
use Sphere\Core\Model\Common\Context;
use Sphere\Core\Request\AbstractApiRequest;
use Sphere\Core\Request\QueryTrait;
use Sphere\Core\Request\StagedTrait;
use Sphere\Core\Response\PagedQueryResponse;

class ProductProjectionFetchBySlugRequest extends AbstractApiRequest
{
    use QueryTrait;
    use StagedTrait;

    const SKU = 'sku';

    /**
     * @param string $slug
     * @param Context $context
     */
    public function __construct($slug, Context $context)
    {
        parent::__construct(ProductSearchEndpoint::endpoint());
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
     * @return HttpRequest
     * @internal
     */
    public function httpRequest()
    {
        $request = new HttpRequest(HttpMethod::GET, $this->getPath());
        return $request;
    }

    /**
     * @param $response
     * @return PagedQueryResponse
     * @internal
     */
    public function buildResponse($response)
    {
        return new PagedQueryResponse($response, $this);
    }
}
