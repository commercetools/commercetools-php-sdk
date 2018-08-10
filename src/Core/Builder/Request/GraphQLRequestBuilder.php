<?php
// phpcs:ignoreFile
namespace Commercetools\Core\Builder\Request;

use Commercetools\Core\Request\GraphQL\GraphQLQueryRequest;

class GraphQLRequestBuilder
{

    /**
     *
     * @param 
     * @return GraphQLQueryRequest
     */
    public function query()
    {
        $request = GraphQLQueryRequest::of();
        return $request;
    }

    /**
     * @return GraphQLRequestBuilder
     */
    public function of()
    {
        return new self();
    }
}
