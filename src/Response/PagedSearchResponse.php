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
        if (is_null($this->facets)) {
            $this->facets = FacetResultCollection::fromArray($this->getResponseKey(static::FACETS));
        }
        return $this->facets;
    }
}
