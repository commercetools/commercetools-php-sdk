<?php
/**
 * @author @jayS-de <jens.schulze@commercetools.de>
 */


namespace Commercetools\Core\GraphQL;

use Commercetools\Core\ApiTestCase;
use Commercetools\Core\Model\Common\LocalizedString;
use Commercetools\Core\Model\Common\Money;
use Commercetools\Core\Model\Common\PriceDraft;
use Commercetools\Core\Model\Common\PriceDraftCollection;
use Commercetools\Core\Model\Product\Product;
use Commercetools\Core\Model\Product\ProductDraft;
use Commercetools\Core\Model\Product\ProductVariantDraft;
use Commercetools\Core\Model\ProductType\ProductType;
use Commercetools\Core\Model\ProductType\ProductTypeDraft;
use Commercetools\Core\Model\TaxCategory\TaxCategory;
use Commercetools\Core\Model\TaxCategory\TaxCategoryDraft;
use Commercetools\Core\Model\TaxCategory\TaxRate;
use Commercetools\Core\Model\TaxCategory\TaxRateCollection;
use Commercetools\Core\Request\GraphQL\GraphQLQueryRequest;
use Commercetools\Core\Request\Products\Command\ProductPublishAction;
use Commercetools\Core\Request\Products\Command\ProductUnpublishAction;
use Commercetools\Core\Request\Products\ProductCreateRequest;
use Commercetools\Core\Request\Products\ProductDeleteRequest;
use Commercetools\Core\Request\Products\ProductUpdateRequest;
use Commercetools\Core\Request\ProductTypes\ProductTypeCreateRequest;
use Commercetools\Core\Request\ProductTypes\ProductTypeDeleteRequest;
use Commercetools\Core\Request\TaxCategories\TaxCategoryCreateRequest;
use Commercetools\Core\Request\TaxCategories\TaxCategoryDeleteRequest;

class GraphQLQueryTest extends ApiTestCase
{
    public function testGraphQLEndpoint()
    {
        $product = $this->getProduct();

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
}
