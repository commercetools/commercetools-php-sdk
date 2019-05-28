<?php
/**
 * @author @jenschude <jens.schulze@commercetools.de>
 */


namespace Commercetools\Core\IntegrationTests\ProductDiscount;

use Commercetools\Core\IntegrationTests\ApiTestCase;
use Commercetools\Core\Model\Common\LocalizedString;
use Commercetools\Core\Model\Common\Money;
use Commercetools\Core\Model\Common\MoneyCollection;
use Commercetools\Core\Model\ProductDiscount\ProductDiscount;
use Commercetools\Core\Model\ProductDiscount\ProductDiscountDraft;
use Commercetools\Core\Model\ProductDiscount\ProductDiscountValue;
use Commercetools\Core\Request\ProductDiscounts\ProductDiscountByIdGetRequest;
use Commercetools\Core\Request\ProductDiscounts\ProductDiscountCreateRequest;
use Commercetools\Core\Request\ProductDiscounts\ProductDiscountDeleteRequest;
use Commercetools\Core\Request\ProductDiscounts\ProductDiscountQueryRequest;

class ProductDiscountQueryRequestTest extends ApiTestCase
{
    /**
     * @return ProductDiscountDraft
     */
    protected function getDraft()
    {
        $draft = ProductDiscountDraft::ofNameDiscountPredicateOrderAndActive(
            LocalizedString::ofLangAndText('en', 'test-' . $this->getTestRun() . '-discount'),
            ProductDiscountValue::of()->setType('absolute')->setMoney(
                MoneyCollection::of()
                    ->add(Money::ofCurrencyAndAmount('EUR', 100))
            ),
            '1=1',
            '0.9' . trim((string)mt_rand(1, 1000), '0'),
            false
        );

        return $draft;
    }

    protected function createProductDiscount(ProductDiscountDraft $draft)
    {
        $request = ProductDiscountCreateRequest::ofDraft($draft);
        $response = $request->executeWithClient($this->getClient());
        $productDiscount = $request->mapResponse($response);

        $this->cleanupRequests[] = ProductDiscountDeleteRequest::ofIdAndVersion(
            $productDiscount->getId(),
            $productDiscount->getVersion()
        );

        return $productDiscount;
    }

    public function testQuery()
    {
        $draft = $this->getDraft();
        $productDiscount = $this->createProductDiscount($draft);

        $request = ProductDiscountQueryRequest::of()->where('name(en="' . $draft->getName()->en . '")');
        $response = $request->executeWithClient($this->getClient());
        $result = $request->mapResponse($response);

        $this->assertCount(1, $result);
        $this->assertInstanceOf(ProductDiscount::class, $result->getAt(0));
        $this->assertSame($productDiscount->getId(), $result->getAt(0)->getId());
    }

    public function testGetById()
    {
        $draft = $this->getDraft();
        $productDiscount = $this->createProductDiscount($draft);

        $request = ProductDiscountByIdGetRequest::ofId($productDiscount->getId());
        $response = $request->executeWithClient($this->getClient());
        $result = $request->mapResponse($response);

        $this->assertInstanceOf(ProductDiscount::class, $productDiscount);
        $this->assertSame($productDiscount->getId(), $result->getId());
    }
}
