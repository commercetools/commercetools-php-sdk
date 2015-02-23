<?php
/**
 * @author @ct-jensschulze <jens.schulze@commercetools.de>
 * @created: 02.02.15, 11:26
 */

namespace Sphere\Core\Request\Products;

use GuzzleHttp\Message\ResponseInterface;
use Sphere\Core\Request\AbstractProjectionRequest;
use Sphere\Core\Request\PageTrait;
use Sphere\Core\Request\SortTrait;
use Sphere\Core\Response\PagedQueryResponse;

/**
 * Class ProductsSearchRequest
 * @package Sphere\Core\Request\Products
 * @method static ProductsSearchRequest of()
 */
class ProductsSearchRequest extends AbstractProjectionRequest
{
    use PageTrait;
    use SortTrait;

    /**
     *
     */
    public function __construct()
    {
        parent::__construct(ProductSearchEndpoint::endpoint());
    }

    /**
     * @return string
     */
    protected function getProjectionAction()
    {
        return 'search';
    }

    /**
     * @param ResponseInterface $response
     * @return PagedQueryResponse
     * @internal
     */
    public function buildResponse(ResponseInterface $response)
    {
        return new PagedQueryResponse($response, $this, $this->getContext());
    }
}
