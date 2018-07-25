<?php
/**
 *
 */

namespace Commercetools\Core\ProductDiscount;

use Commercetools\Core\ApiTestCase;
use Commercetools\Core\Model\Common\LocalizedString;
use Commercetools\Core\Model\Common\Money;
use Commercetools\Core\Model\Common\MoneyCollection;
use Commercetools\Core\Model\Common\Price;
use Commercetools\Core\Model\Common\PriceDraft;
use Commercetools\Core\Model\Common\PriceDraftCollection;
use Commercetools\Core\Model\Product\ProductDraft;
use Commercetools\Core\Model\Product\ProductVariant;
use Commercetools\Core\Model\Product\ProductVariantDraft;
use Commercetools\Core\Model\ProductDiscount\ProductDiscount;
use Commercetools\Core\Model\ProductDiscount\ProductDiscountDraft;
use Commercetools\Core\Model\ProductDiscount\ProductDiscountValue;
use Commercetools\Core\Request\ProductDiscounts\ProductDiscountCreateRequest;
use Commercetools\Core\Request\ProductDiscounts\ProductDiscountDeleteRequest;
use Commercetools\Core\Request\ProductDiscounts\ProductDiscountMatchingRequest;
use Commercetools\Core\Request\Products\Command\ProductAddVariantAction;
use Commercetools\Core\Request\Products\ProductCreateRequest;
use Commercetools\Core\Request\Products\ProductDeleteRequest;
use Commercetools\Core\Request\Products\ProductUpdateRequest;

class ProductDiscountMatchingRequestTest extends ApiTestCase
{
    /**
     * @return ProductDiscountDraft
     */
    protected function getProductDiscountDraft()
    {
        $draft = ProductDiscountDraft::ofNameDiscountPredicateOrderAndActive(
            LocalizedString::ofLangAndText('en', 'test-' . $this->getTestRun() . '-discount'),
            ProductDiscountValue::of()->setType('absolute')->setMoney(
                MoneyCollection::of()
                    ->add(Money::ofCurrencyAndAmount('EUR', 100))
            ),
            'sku="' . $this->getTestRun() . '-sku"',
            '0.9' . trim((string)mt_rand(1, 1000), '0'),
            true
        );

        return $draft;
    }

    protected function createProductDiscount(ProductDiscountDraft $draft)
    {
        $request = ProductDiscountCreateRequest::ofDraft($draft);
        $response = $request->executeWithClient($this->getClient());
//        var_export($response);
        $productDiscount = $request->mapResponse($response);

        $this->cleanupRequests[] = ProductDiscountDeleteRequest::ofIdAndVersion(
            $productDiscount->getId(),
            $productDiscount->getVersion()
        );

        return $productDiscount;
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
        );

        return $draft;
    }

    protected function createProduct(ProductDraft $draft)
    {
        $request = ProductCreateRequest::ofDraft($draft);
        $response = $request->executeWithClient($this->getClient());
        $product = $request->mapResponse($response);

        $this->cleanupRequests[] = $this->deleteRequest = ProductDeleteRequest::ofIdAndVersion(
            $product->getId(),
            $product->getVersion()
        );

        return $product;
    }

    public function testMatchingProductDiscount()
    {
        $productDraft = $this->getProductDraft();
        $sku = $this->getTestRun() . '-sku';
        $productDraft->setMasterVariant(
            ProductVariantDraft::of()->setSku($sku)->setKey($sku)->setPrices(
                PriceDraftCollection::of()->add(
                    PriceDraft::ofMoney(Money::ofCurrencyAndAmount('EUR', 100))
                )
            )
        );
        $product = $this->createProduct($productDraft);

        $productDiscountDraft = $this->getProductDiscountDraft();
        $productDiscount = $this->createProductDiscount($productDiscountDraft);

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
