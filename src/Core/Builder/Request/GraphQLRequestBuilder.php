<?php
// phpcs:disable Generic.Files.LineLength
namespace Commercetools\Core\Builder\Request;

use Commercetools\Core\Request\GraphQL\GraphQLQueryRequest;

class GraphQLRequestBuilder
{

    /**
     *
     *
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
