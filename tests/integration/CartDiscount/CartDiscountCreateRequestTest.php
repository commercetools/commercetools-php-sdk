<?php
/**
 * @author @jenschude <jens.schulze@commercetools.de>
 */


namespace Commercetools\Core\IntegrationTests\CartDiscount;

use Commercetools\Core\IntegrationTests\ApiTestCase;
use Commercetools\Core\Model\CartDiscount\CartDiscountDraft;
use Commercetools\Core\Model\CartDiscount\CartDiscountTarget;
use Commercetools\Core\Model\CartDiscount\CartDiscountValue;
use Commercetools\Core\Model\Common\LocalizedString;
use Commercetools\Core\Model\Common\Money;
use Commercetools\Core\Model\Common\MoneyCollection;
use Commercetools\Core\Request\CartDiscounts\CartDiscountCreateRequest;
use Commercetools\Core\Request\CartDiscounts\CartDiscountDeleteRequest;

class CartDiscountCreateRequestTest extends ApiTestCase
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


    public function testCreate()
    {
        $draft = $this->getDraft();
        $cartDiscount = $this->createCartDiscount($draft);
        $this->assertSame($draft->getName()->en, $cartDiscount->getName()->en);
        $this->assertSame(
            $draft->getValue()->getMoney()->current()->getCentAmount(),
            $cartDiscount->getValue()->getMoney()->current()->getCentAmount()
        );
        $this->assertSame(
            $draft->getValue()->getMoney()->current()->getCurrencyCode(),
            $cartDiscount->getValue()->getMoney()->current()->getCurrencyCode()
        );
        $this->assertSame($draft->getCartPredicate(), $cartDiscount->getCartPredicate());
        $this->assertSame($draft->getTarget()->getType(), $cartDiscount->getTarget()->getType());
        $this->assertSame($draft->getTarget()->getPredicate(), $cartDiscount->getTarget()->getPredicate());
        $this->assertSame($draft->getSortOrder(), $cartDiscount->getSortOrder());
        $this->assertSame($draft->getIsActive(), $cartDiscount->getIsActive());
        $this->assertSame($draft->getRequiresDiscountCode(), $cartDiscount->getRequiresDiscountCode());
    }
}
