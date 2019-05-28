<?php
/**
 * @author @jenschude <jens.schulze@commercetools.de>
 */


namespace Commercetools\Core\IntegrationTests\GraphQL;

use Commercetools\Core\IntegrationTests\ApiTestCase;
use Commercetools\Core\Request\GraphQL\GraphQLQueryRequest;

class GraphQLQueryTest extends ApiTestCase
{
    public function testGraphQLEndpoint()
    {
        $product = $this->getProduct();

        $request = GraphQLQueryRequest::of();

        $query = <<<GRAPHQL
query Sphere(\$productQuery: String!) {
    products(limit: 1, where: \$productQuery) {
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
        $request->addVariable('productQuery', sprintf('id = "%s"', $product->getId()));

        $response = $request->executeWithClient($this->getClient());

        $data = $response->toArray();

        $this->assertArrayHasKey('data', $data);
        $this->assertArrayHasKey('products', $data['data']);
        $this->assertArrayHasKey('results', $data['data']['products']);
        $this->assertCount(1, $data['data']['products']['results']);
        $result = current($data['data']['products']['results']);
        $this->assertSame($product->getId(), $result['id']);
        $this->assertArrayHasKey('staged', $result['masterData']);
        $this->assertArrayHasKey('current', $result['masterData']);

        $this->assertSame(
            $product->getMasterData()->getCurrent()->getMasterVariant()->getSku(),
            current($result['masterData']['current']['skus'])
        );
        $this->assertSame(
            $product->getMasterData()->getCurrent()->getName()->en,
            $result['masterData']['current']['name']
        );

        $this->assertSame(
            $product->getMasterData()->getStaged()->getMasterVariant()->getSku(),
            current($result['masterData']['staged']['skus'])
        );
        $this->assertSame(
            $product->getMasterData()->getStaged()->getName()->en,
            $result['masterData']['staged']['name']
        );
    }

    public function testWithoutVariables()
    {
        $request = GraphQLQueryRequest::of();

        $query = <<<GRAPHQL
query Sphere {
    products {
        count
    }
}
GRAPHQL;

        $request->query($query);

        $response = $request->executeWithClient($this->getClient());
        $this->assertFalse($response->isError());
    }
}
