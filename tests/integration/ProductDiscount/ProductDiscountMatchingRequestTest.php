<?php
/**
 *
 */

namespace Commercetools\Core\IntegrationTests\ProductDiscount;

use Commercetools\Core\IntegrationTests\ApiTestCase;
use Commercetools\Core\Model\Common\Money;
use Commercetools\Core\Model\Common\MoneyCollection;
use Commercetools\Core\Model\Common\PriceDraft;
use Commercetools\Core\Model\Common\PriceDraftCollection;
use Commercetools\Core\Model\Product\ProductVariantDraft;
use Commercetools\Core\Model\ProductDiscount\ProductDiscount;
use Commercetools\Core\Model\ProductDiscount\ProductDiscountValue;
use Commercetools\Core\Request\ProductDiscounts\ProductDiscountMatchingRequest;

class ProductDiscountMatchingRequestTest extends ApiTestCase
{
//    todo missing migration of Product
    public function testMatchingProductDiscount()
    {
        $productDraft = $this->getProductDraft();
        $sku = $this->getTestRun() . '-sku';
        $productDraft->setMasterVariant(
            ProductVariantDraft::ofSkuAndPrices(
                $sku,
                PriceDraftCollection::of()->add(
                    PriceDraft::ofMoney(Money::ofCurrencyAndAmount('EUR', 100))
                )
            )->setKey($sku)
        );
        $product = $this->getProduct($productDraft);

        $productDiscountValue = ProductDiscountValue::of()->setType('absolute')->setMoney(
            MoneyCollection::of()
                ->add(Money::ofCurrencyAndAmount('EUR', 100))
        );
        $productDiscount = $this->getProductDiscount($productDiscountValue, 'sku="' . $this->getTestRun() . '-sku"');

        $retries = 0;
        do {
            $retries++;
            sleep(1);

            $request = ProductDiscountMatchingRequest::ofProductIdVariantIdAndPrice(
                $product->getId(),
                $product->getMasterData()->getCurrent()->getMasterVariant()->getId(),
                $product->getMasterData()->getCurrent()->getMasterVariant()->getPrices()->current()
            );
            $response = $request->executeWithClient($this->getClient());
            $matchedProductDiscount = $request->mapResponse($response);
        } while (is_null($matchedProductDiscount) && $retries <= 9);

        if (is_null($matchedProductDiscount)) {
            $this->markTestSkipped('Product discount on product, not updated in time');
        }

        $this->assertInstanceOf(ProductDiscount::class, $matchedProductDiscount);
        $this->assertEquals($productDiscount->getId(), $matchedProductDiscount->getId());
        $this->assertEquals($productDiscount->getVersion(), $matchedProductDiscount->getVersion());
        $this->assertEquals($productDiscount->getValue(), $matchedProductDiscount->getValue());
    }
}
