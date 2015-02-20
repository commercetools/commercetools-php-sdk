<?php
/**
 * @author @ct-jensschulze <jens.schulze@commercetools.de>
 */

namespace Sphere\Core\Request\Products;


use Sphere\Core\Client\HttpMethod;
use Sphere\Core\Client\HttpRequest;
use Sphere\Core\Request\AbstractApiRequest;
use Sphere\Core\Request\QueryTrait;
use Sphere\Core\Request\StagedTrait;
use Sphere\Core\Response\PagedQueryResponse;
use Sphere\Core\Response\SingleResourceResponse;

class ProductProjectionFetchBySkuRequest extends AbstractApiRequest
{
    use QueryTrait;
    use StagedTrait;

    const SKU = 'sku';

    /**
     * @param string $sku
     */
    public function __construct($sku)
    {
        parent::__construct(ProductSearchEndpoint::endpoint());
        if (!is_null($sku)) {
            $this->where(sprintf('masterVariant(sku="%1$s") or variants(sku="%1$s")', $sku));
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
