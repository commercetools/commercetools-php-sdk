<?php
/**
 * @author @jenschude <jens.schulze@commercetools.de>
 */

namespace Commercetools\Core\Builder\Request;

use Commercetools\Core\Request\GraphQL\GraphQLQueryRequest;

class GraphQLRequestBuilder
{
    /**
     * @return GraphQLQueryRequest
     */
    public function query()
    {
        return GraphQLQueryRequest::of();
    }
}
