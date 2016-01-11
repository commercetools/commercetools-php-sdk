<?php
/**
 * @author @jayS-de <jens.schulze@commercetools.de>
 */

namespace Commercetools\Core\Response;

use GuzzleHttp\Message\ResponseInterface;
use Commercetools\Core\Model\Common\Context;
use Commercetools\Core\Model\Product\FacetResultCollection;
use Commercetools\Core\Request\ClientRequestInterface;

/**
 * @package Commercetools\Core\Response
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
