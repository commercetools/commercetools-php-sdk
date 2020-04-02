<?php
/**
 *
 */

namespace Commercetools\Core\IntegrationTests\ProductDiscount;

use Commercetools\Core\Builder\Request\RequestBuilder;
use Commercetools\Core\IntegrationTests\ApiTestCase;
use Commercetools\Core\IntegrationTests\Product\ProductFixture;
use Commercetools\Core\Model\Common\Money;
use Commercetools\Core\Model\Common\PriceDraft;
use Commercetools\Core\Model\Common\PriceDraftCollection;
use Commercetools\Core\Model\Product\Product;
use Commercetools\Core\Model\Product\ProductDraft;
use Commercetools\Core\Model\Product\ProductVariantDraft;
use Commercetools\Core\Model\ProductDiscount\ProductDiscount;
use Commercetools\Core\Model\ProductDiscount\ProductDiscountDraft;

class ProductDiscountMatchingRequestTest extends ApiTestCase
{
    public function testMatchingProductDiscount()
    {
        $client = $this->getApiClient();
        $sku = 'sku-' . ProductFixture::uniqueProductString();

        ProductFixture::withDraftProduct(
            $client,
            function (ProductDraft $productDraft) use ($sku) {
                return $productDraft->setMasterVariant(
                    ProductVariantDraft::ofSkuAndPrices(
                        $sku,
                        PriceDraftCollection::of()->add(
                            PriceDraft::ofMoney(Money::ofCurrencyAndAmount('EUR', 100))
                        )
                    )->setKey($sku)
                );
            },
            function (Product $product) use ($client, $sku) {
                ProductDiscountFixture::withDraftProductDiscount(
                    $client,
                    function (ProductDiscountDraft $productDiscountDraft) use ($sku) {
                        return $productDiscountDraft->setPredicate('sku="' . $sku . '"')
                            ->setIsActive(true);
                    },
                    function (ProductDiscount $productDiscount) use ($client, $product) {
                        $retries = 0;
                        do {
                            $retries++;
                            sleep(1);

                            $request = RequestBuilder::of()->productDiscounts()->matching(
                                $product->getId(),
                                $product->getMasterData()->getCurrent()->getMasterVariant()->getId(),
                                $product->getMasterData()->getCurrent()->getMasterVariant()->getPrices()->current()
                            );
                            $response = $this->execute($client, $request);
                            $matchedProductDiscount = $request->mapFromResponse($response);
                        } while (is_null($matchedProductDiscount) && $retries <= 9);

                        if (is_null($matchedProductDiscount)) {
                            $this->markTestSkipped('Product discount on product, not updated in time');
                        }

                        $this->assertInstanceOf(ProductDiscount::class, $matchedProductDiscount);
                        $this->assertEquals($productDiscount->getId(), $matchedProductDiscount->getId());
                        $this->assertEquals($productDiscount->getVersion(), $matchedProductDiscount->getVersion());
                        $this->assertEquals($productDiscount->getValue(), $matchedProductDiscount->getValue());
                    }
                );
            }
        );
    }
}
