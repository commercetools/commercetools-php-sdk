<?php
/**
 * @author @ct-jensschulze <jens.schulze@commercetools.de>
 */

namespace Sphere\Core\Response;

use GuzzleHttp\Message\ResponseInterface;
use Sphere\Core\Model\Common\Context;
use Sphere\Core\Model\Product\FacetResultCollection;
use Sphere\Core\Request\ClientRequestInterface;

/**
 * Class PagedSearchResponse
 * @package Sphere\Core\Response
 */
class PagedSearchResponse extends PagedQueryResponse
{
    const FACETS = 'facets';

    /**
     * @var FacetResultCollection
     */
    protected $facets;

    /**
     * @return FacetResultCollection
     */
    public function getFacets()
    {
        return $this->facets;
    }

    /**
     * @param FacetResultCollection $facets
     */
    public function setFacets(FacetResultCollection $facets)
    {
        $this->facets = $facets;
    }

    public function __construct(ResponseInterface $response, ClientRequestInterface $request, Context $context = null)
    {
        parent::__construct($response, $request, $context);
        if (!$this->isError()) {
            $jsonResponse = $this->toArray();
            if (isset($jsonResponse[static::FACETS])) {
                $facets = FacetResultCollection::fromArray($jsonResponse[static::FACETS]);
                $this->setFacets(FacetResultCollection::fromArray($facets));
            }
        }
    }
}
