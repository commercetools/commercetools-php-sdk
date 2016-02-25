<?php
/**
 * @author @jayS-de <jens.schulze@commercetools.de>
 */


namespace Commercetools\Core\GraphQL;

use Commercetools\Core\ApiTestCase;
use Commercetools\Core\Request\GraphQL\GraphQLQueryRequest;

class GraphQLQueryTest extends ApiTestCase
{
    public function testGraphQLEndpoint()
    {
        $this->markTestIncomplete();

        $request = GraphQLQueryRequest::of();

        $query = <<<GRAPHQL
query Sphere {
  products(limit: 1) {
    ...StagedProduct,
    ...CurrentProduct
  }
}

fragment Product on ProductData {
  skus, name(locale: "en")
}

fragment StagedProduct on ProductQueryResult {
  results {
    id, masterData { staged { ...Product } }
  }
}

fragment CurrentProduct on ProductQueryResult {
  results {
    id, masterData { current { ...Product } }
  }
}
GRAPHQL;

        $request->query($query);

        $response = $request->executeWithClient($this->getClient());

        $data = $response->toArray();
        $this->assertArrayHasKey('results', $data);
    }
}
