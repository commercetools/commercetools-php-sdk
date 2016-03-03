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
    /**
     * @var Product
     */
    private $product;

    /**
     * @var ProductType
     */
    private $productType;

    /**
     * @var TaxCategory
     */
    private $taxCategory;

    /**
     * @var string
     */
    private $state;

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

    protected function cleanup()
    {
        parent::cleanup();
        $this->deleteProduct();
        $this->deleteProductType();
        $this->deleteTaxCategory();
    }

    private function getState()
    {
        if (is_null($this->state)) {
            $this->state = (string)mt_rand(1, 1000);
        }

        return $this->state;
    }

    protected function getProductType()
    {
        if (is_null($this->productType)) {
            $productTypeDraft = ProductTypeDraft::ofNameAndDescription(
                'test-' . $this->getTestRun() . '-productType',
                'test-' . $this->getTestRun() . '-productType'
            );
            $request = ProductTypeCreateRequest::ofDraft($productTypeDraft);
            $response = $request->executeWithClient($this->getClient());
            $this->productType = $request->mapResponse($response);
        }

        return $this->productType;
    }

    protected function deleteProductType()
    {
        if (!is_null($this->productType)) {
            $request = ProductTypeDeleteRequest::ofIdAndVersion(
                $this->productType->getId(),
                $this->productType->getVersion()
            );
            $response = $request->executeWithClient($this->getClient());
            $this->productType = $request->mapResponse($response);
        }
        $this->productType = null;
    }

    /**
     * @return ProductDraft
     */
    protected function getProductDraft()
    {
        $draft = ProductDraft::ofTypeNameAndSlug(
            $this->getProductType()->getReference(),
            LocalizedString::ofLangAndText('en', 'test-' . $this->getTestRun() . '-product'),
            LocalizedString::ofLangAndText('en', 'test-' . $this->getTestRun() . '-product')
        )
            ->setMasterVariant(
                ProductVariantDraft::of()->setSku('test-' . $this->getTestRun() . '-sku')
                    ->setPrices(
                        PriceDraftCollection::of()->add(
                            PriceDraft::ofMoney(Money::ofCurrencyAndAmount('EUR', 100))
                                ->setCountry('DE')
                        )
                    )
            )
            ->setTaxCategory($this->getTaxCategory()->getReference())
        ;

        return $draft;
    }

    protected function getProduct()
    {
        if (is_null($this->product)) {
            $request = ProductCreateRequest::ofDraft($this->getProductDraft());
            $response = $request->executeWithClient($this->getClient());
            $product = $request->mapResponse($response);
            $request = ProductUpdateRequest::ofIdAndVersion($product->getId(), $product->getVersion())
                ->addAction(ProductPublishAction::of());
            $response = $request->executeWithClient($this->getClient());
            $product = $request->mapResponse($response);

            $this->product = $product;
        }

        return $this->product;

    }

    protected function deleteProduct()
    {
        if (!is_null($this->product)) {
            $request = ProductUpdateRequest::ofIdAndVersion($this->product->getId(), $this->product->getVersion())
                ->addAction(ProductUnpublishAction::of());
            $response = $request->executeWithClient($this->getClient());
            $this->product = $request->mapResponse($response);

            $request = ProductDeleteRequest::ofIdAndVersion(
                $this->product->getId(),
                $this->product->getVersion()
            );

            $response = $request->executeWithClient($this->getClient());
            $request->mapResponse($response);
        }

        $this->product = null;
    }

    private function getTaxCategory()
    {
        if (is_null($this->taxCategory)) {
            $taxCategoryDraft = TaxCategoryDraft::ofNameAndRates(
                'test-' . $this->getTestRun() . '-name',
                TaxRateCollection::of()->add(
                    TaxRate::of()->setName('test-' . $this->getTestRun() . '-name')
                        ->setAmount((float)('0.2' . mt_rand(1, 100)))
                        ->setIncludedInPrice(true)
                        ->setCountry('DE')
                        ->setState($this->getState())
                )
            );
            $request = TaxCategoryCreateRequest::ofDraft($taxCategoryDraft);
            $response = $request->executeWithClient($this->getClient());
            $this->taxCategory = $request->mapResponse($response);
        }

        return $this->taxCategory;
    }

    private function deleteTaxCategory()
    {
        if (!is_null($this->taxCategory)) {
            $request = TaxCategoryDeleteRequest::ofIdAndVersion(
                $this->taxCategory->getId(),
                $this->taxCategory->getVersion()
            );
            $response = $request->executeWithClient($this->getClient());
            $this->taxCategory = $request->mapResponse($response);
        }
        $this->taxCategory = null;
    }
}
