<?php
/**
 * @author @jenschude <jens.schulze@commercetools.de>
 */


namespace Commercetools\Core\CartDiscount;

use Commercetools\Core\ApiTestCase;
use Commercetools\Core\Model\CartDiscount\CartDiscount;
use Commercetools\Core\Model\CartDiscount\CartDiscountDraft;
use Commercetools\Core\Model\CartDiscount\CartDiscountTarget;
use Commercetools\Core\Model\CartDiscount\CartDiscountValue;
use Commercetools\Core\Model\Common\LocalizedString;
use Commercetools\Core\Model\Common\Money;
use Commercetools\Core\Model\Common\MoneyCollection;
use Commercetools\Core\Request\CartDiscounts\CartDiscountByIdGetRequest;
use Commercetools\Core\Request\CartDiscounts\CartDiscountByKeyGetRequest;
use Commercetools\Core\Request\CartDiscounts\CartDiscountCreateRequest;
use Commercetools\Core\Request\CartDiscounts\CartDiscountDeleteRequest;
use Commercetools\Core\Request\CartDiscounts\CartDiscountQueryRequest;

class CartDiscountQueryRequestTest extends ApiTestCase
{
    /**
     * @return CartDiscountDraft
     */
    protected function getDraft()
    {
        $draft = CartDiscountDraft::ofNameValuePredicateTargetOrderActiveAndDiscountCode(
            LocalizedString::ofLangAndText('en', 'test-' . $this->getTestRun() . '-discount'),
            CartDiscountValue::of()->setType('absolute')->setMoney(
                MoneyCollection::of()->add(Money::ofCurrencyAndAmount('EUR', 100))
            ),
            '1=1',
            CartDiscountTarget::of()->setType('lineItems')->setPredicate('1=1'),
            '0.9' . trim((string)mt_rand(1, 1000), '0'),
            true,
            false
        );

        return $draft;
    }

    protected function createCartDiscount(CartDiscountDraft $draft)
    {
        $request = CartDiscountCreateRequest::ofDraft($draft);
        $response = $request->executeWithClient($this->getClient());
        $cartDiscount = $request->mapResponse($response);

        $this->cleanupRequests[] = CartDiscountDeleteRequest::ofIdAndVersion(
            $cartDiscount->getId(),
            $cartDiscount->getVersion()
        );

        return $cartDiscount;
    }

    public function testQuery()
    {
        $draft = $this->getDraft();
        $cartDiscount = $this->createCartDiscount($draft);

        $request = CartDiscountQueryRequest::of()->where('name(en="' . $draft->getName()->en . '")');
        $response = $request->executeWithClient($this->getClient());
        $result = $request->mapResponse($response);

        $this->assertCount(1, $result);
        $this->assertInstanceOf(CartDiscount::class, $result->getAt(0));
        $this->assertSame($cartDiscount->getId(), $result->getAt(0)->getId());
    }

    public function testGetById()
    {
        $draft = $this->getDraft();
        $cartDiscount = $this->createCartDiscount($draft);

        $request = CartDiscountByIdGetRequest::ofId($cartDiscount->getId());
        $response = $request->executeWithClient($this->getClient());
        $result = $request->mapResponse($response);

        $this->assertInstanceOf(CartDiscount::class, $result);
        $this->assertSame($cartDiscount->getId(), $result->getId());
    }

    public function testGetByKey()
    {
        $draft = $this->getDraft()->setKey('test-' . $this->getTestRun() . '-discount');
        $cartDiscount = $this->createCartDiscount($draft);

        $request = CartDiscountByKeyGetRequest::ofKey($cartDiscount->getKey());
        $response = $request->executeWithClient($this->getClient());
        $result = $request->mapResponse($response);

        $this->assertInstanceOf(CartDiscount::class, $result);
        $this->assertSame($cartDiscount->getId(), $result->getId());
        $this->assertSame($cartDiscount->getKey(), $result->getKey());
    }
}
