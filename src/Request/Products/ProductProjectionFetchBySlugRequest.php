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
use Sphere\Core\Response\PagedQueryResponse;

class ProductProjectionFetchBySlugRequest extends AbstractApiRequest
{
    use QueryTrait;

    const SKU = 'sku';

    /**
     * @param string $sku
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
        var_dump($response);
        var_dump($response->getBody());
        return new PagedQueryResponse($response, $this);
    }
}
