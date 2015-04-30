<?php
/**
 * @author @ct-jensschulze <jens.schulze@commercetools.de>
 * @created: 02.02.15, 11:26
 */

namespace Sphere\Core\Request\Products;

use GuzzleHttp\Message\ResponseInterface;
use Sphere\Core\Model\Common\Context;
use Sphere\Core\Model\Product\Facet;
use Sphere\Core\Model\Product\Filter;
use Sphere\Core\Model\Product\ProductProjectionCollection;
use Sphere\Core\Request\AbstractProjectionRequest;
use Sphere\Core\Request\PageTrait;
use Sphere\Core\Request\SortTrait;
use Sphere\Core\Response\PagedQueryResponse;
use Sphere\Core\Response\PagedSearchResponse;

/**
 * Class ProductsSearchRequest
 * @package Sphere\Core\Request\Products
 * @link http://dev.sphere.io/http-api-projects-products-search.html#product-projections-by-search
 * @method static ProductsSearchRequest of()
 */
class ProductsSearchRequest extends AbstractProjectionRequest
{
    const FACET = 'facet';
    const FILTER = 'filter';
    const FILTER_QUERY = 'filter.query';
    const FILTER_FACETS = 'filter.facets';

    use PageTrait;
    use SortTrait;

    protected $resultClass = '\Sphere\Core\Model\Product\ProductProjectionCollection';

    /**
     * @param Context $context
     */
    public function __construct(Context $context = null)
    {
        parent::__construct(ProductSearchEndpoint::endpoint(), $context);
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
        return new PagedSearchResponse($response, $this, $this->getContext());
    }

    /**
     * @param array $result
     * @param Context $context
     * @return ProductProjectionCollection
     */
    public function mapResult(array $result, Context $context = null)
    {
        $data = [];
        if (!empty($result['results'])) {
            $data = $result['results'];
        }
        return ProductProjectionCollection::fromArray($data, $context);
    }

    /**
     * @param string $type
     * @param Filter $filter
     * @return $this
     */
    protected function filter($type, Filter $filter)
    {
        return $this->addParam($type, $filter);
    }

    /**
     * @param Filter $filter
     * @return $this
     */
    public function addFilter(Filter $filter)
    {
        return $this->filter(static::FILTER, $filter);
    }

    /**
     * @param Filter $filter
     * @return $this
     */
    public function addFilterQuery(Filter $filter)
    {
        return $this->filter(static::FILTER_QUERY, $filter);
    }

    /**
     * @param Filter $filter
     * @return $this
     */
    public function addFilterFacets(Filter $filter)
    {
        return $this->filter(static::FILTER_FACETS, $filter);
    }

    /**
     * @param Facet $filter
     * @return $this
     */
    public function addFacet(Facet $filter)
    {
        return $this->filter(static::FACET, $filter);
    }
}
